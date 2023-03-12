<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SoalController extends Controller
{
    public function numberToWords($number)
    {
        $words = array(
            0 => '',
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
            10 => 'Sepuluh',
            11 => 'Sebelas',
            12 => 'Dua Belas',
            13 => 'Tiga Belas',
            14 => 'Empat Belas',
            15 => 'Lima Belas',
            16 => 'Enam Belas',
            17 => 'Tujuh Belas',
            18 => 'Delapan Belas',
            19 => 'Sembilan Belas',
            20 => 'Dua Puluh',
            30 => 'Tiga Puluh',
            40 => 'Empat Puluh',
            50 => 'Lima Puluh',
            60 => 'Enam Puluh',
            70 => 'Tujuh Puluh',
            80 => 'Delapan Puluh',
            90 => 'Sembilan Puluh',
            100 => 'Ratus',
            101 => 'Seratus',
            1000 => 'Ribu',
            1000000 => 'Juta',
            1000000000 => 'Milyar'
        );
    
        if (!is_numeric($number)) {
            return false;
        }
    
        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            throw new Exception('Number out of range');
        }
    
        if ($number < 21) {
            return $words[$number];
        }
    
        if ($number < 100) {
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;

           
            return trim($words[$tens] . ' ' . $words[$units]);
        }
        
        if ($number < 1000) {
            $hundreds = floor($number / 100);
            $remainder = $number % 100;
            if ($remainder == 0) {
              
                if($hundreds > 1) {
                    return trim($words[$hundreds] . ' ' . $words[100]);
                } else {
                    return trim($words[101]);
                }
      
               
            } else {
               
                if($hundreds > 1) {
                    return trim($words[$hundreds] . ' ' . $words[100] . ' ' . $this->numberToWords($remainder));
                } else {
                    return trim($words[101] . ' ' . $this->numberToWords($remainder));
                }
             
                
            }
        }

        
        
        foreach (array(1000000000, 1000000, 1000) as $key) {
            if ($number >= $key) {

              
                $num = floor($number / $key);
                $remainder = $number % $key;
                $remainder = $number % $key;
                if ($remainder == 0) {
                    return trim($this->numberToWords($num) . ' ' . $words[$key]);
                } else {
                    $prefix = $this->numberToWords($num) . ' ' . $words[$key];
                    if ($remainder < 1000) {
                        $suffix = $this->numberToWords($remainder);
                    } else {
                        $suffix = $this->numberToWords($remainder) . ' ';
                    }
                    return trim($prefix . ' ' . $suffix);
                }
               
               
            }
        }
    }

    // Soal no 7
    public function soalNo7(Request $request) {
        $number = 1120002123;
        return $this->numberToWords($number);
    }

    // Soal no 6
    public function soalNo6()
    {
        $a = 5;
        $b = 3;
        $a = $a ^ $b;
        $b = $a ^ $b;
        $a = $a ^ $b;

        return "A = " . $a . ", B = " . $b;
    }

    public function viewSoalNo4() {
        return view('layouts.product-stock');
    }

    // Soal no 4 
    public function soalNo4(Request $request) {
        $validator = \Validator::make($request->all(), [
            'bank_id' => 'required|string',
           
        ]);

        if($validator->fails()){
            $data['status'] = false;
            $data['code'] = 400;
            $data['message'] = 'failed';
            $data['errors'] = $validator->errors();
            
            return response()->json($data);
        }
        $url = "http://149.129.221.143/kanaldata/Webservice/bank_account";

        // Create an array containing the data you want to send in the request body
        $requestData = [
            'bank_id' => $request->bank_id,
        ];
    
        $response = Http::post($url, $requestData);
        $result = json_decode($response->getBody(), true);
    
        return response()->json($result);
    }
    // soal no 1
    // register

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
        ]);

        $user->sendEmailVerificationNotification();

        return response()->json([
          'message' => 'Berhasil register'
        ]);
    }


}

