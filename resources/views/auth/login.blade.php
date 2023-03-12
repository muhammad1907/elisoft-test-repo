<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  @include('layouts.head')

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <form method="POST" action="{{ route('login-process') }}">
                    @csrf

                    @if($errors->has('failed'))
                            <span>{{ $errors->first('failed') }}</span>
                            <br>
                        @endif
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Enter Email Address..."   autofocus required>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password"  name="password" required>
                         @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    
                  </form>
                  <hr>
                  <div class="form-group">
                   
                      <a class="btn btn-link" href="{{ route('register') }}">
                        {{ __('Register') }}
                      </a>
     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</body>

</html>
