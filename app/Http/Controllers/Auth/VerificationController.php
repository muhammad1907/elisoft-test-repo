<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect('/login')->with('error', 'Invalid email address.');
        }
    
        if (!$user->hasVerifiedEmail()) {
            if ($user->markEmailAsVerified()) {
                auth()->login($user);
    
                return redirect('/dashboard')->with('success', 'Your email has been verified.');
            }
    
            return redirect('/login')->with('error', 'Unable to verify your email address. Please try again later.');
        }
    
        return redirect('/dashboard');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'A new verification link has been sent to your email address.');
    }
}
