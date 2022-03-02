<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style type="text/css">
        .btn-color{
          background-color: #0e1c36;
          color: #fff;
          
        }

        .profile-image-pic{
          height: 200px;
          width: 200px;
          object-fit: cover;
        }



        .cardbody-color{
          background-color: #ebf2fa;
        }

        a{
          text-decoration: none;
        }
    </style>

</head>
<body>
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Register Form</h2>
        <div class="card my-5">
          <form class="card-body cardbody-color p-lg-5" id="registerForm">
            <div class="mb-3">
              <input type="text" class="form-control" id="name" placeholder="User Name" required>
            </div>            

            <div class="mb-3">
              <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>

            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="Password" required> 
            </div>            

            <div class="mb-3">
              <input id="confirm_password" type="password" class="form-control" name="confirm_password" required placeholder="Enter Password Confirmation">
            </div>

            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Sign Up</button></div>
            <div class="form-text text-center mb-5 text-dark">Already sign up. <a href="{{url('/')}}" class="text-dark fw-bold"> Login</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {

        var password = document.getElementById("password")
          , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;


            $("#registerForm").submit(function(event)
            {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "api/register",
                    data:({
                        email : $('#email').val(),
                        password: $('#password').val(),
                        name: $('#name').val()
                    }),
                    success: function(result)
                    {
                      if (result.message == 'success') { 
                        localStorage.setItem('token', result.access_token);
                        window.location = '{{ url('dynamic-form') }}'
                      }

                    }
                });
                return false;
            })

        });
       
    </script>
</body>
</html>
