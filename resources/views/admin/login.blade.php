<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Standard Bima </title>

  <!-- Bootstrap -->
  <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- Animate.css -->
  <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="login">
  <div>
    <!-- <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a> -->

    <div class="login_wrapper">
      <div class="animate form login_form">
 
        <section class="login_content">
        @if ($errors->has('error'))
            <p class="text-danger">
              {{ $errors->first('error') }}
            </p>
            @endif 
          <form method="POST" action="{{route('admin.login')}}">
          @csrf
       

            <h1>Admin</h1>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Mobile Number" value="{{ old('mobile') }}"  name="mobile" required="" />
              @error('mobile')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            </div>
           

            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" name="password" required="" />
              @error('password')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            <div>
            </div>
          
          
              <!-- <a class="btn btn-default submit">Log in</a> -->
            <button type="submit" class="btn btn-default">Login</button>

              <a class="reset_pass" href="#">Lost your password?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Standard Bima</h1>
                <p>©2016 All Rights Reserved. Standard Bima is a Bootstrap 4 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>

      <div id="register" class="animate form registration_form">
        <section class="login_content">
          <form>
            <h1>Create Account</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="index.html">Submit</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Already a member ?
                <a href="#signin" class="to_register"> Log in </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                <p>©2024 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>

</html>