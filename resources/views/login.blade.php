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
        <h2 class="text-center text-dark mt-5">Login Form</h2>
        <div class="card my-5">
          <form class="card-body cardbody-color p-lg-5" id="loginForm">
            <div class="mb-3">
              <input type="text" class="form-control" id="email" placeholder="Enter Email">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="password">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href="{{url('/register')}}" class="text-dark fw-bold"> Create an
                Account</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
      $('.fail').hide();
            $("#loginForm").submit(function(event)
            {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "api/login",
                    data:({
                        email : $('#email').val(),
                        password: $('#password').val()
                    }),
                    success: function(result)
                    {
                      if (result.message == 'success') 
                      { 
                        localStorage.setItem('token', result.access_token);
                        window.location = '{{ url('dynamic-form') }}'
                      }
                    },
                    error: function(result)
                    {
                      alert(result.responseJSON.errors);
                    }
                });
                return false;
            })

        });
       
    </script>
</body>
</html>
