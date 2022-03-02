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
        <h2 class="text-center text-dark mt-5">Public Form</h2>
        <div class="card my-5">
          <form class="card-body cardbody-color p-lg-5" id="publicForm">

            <div id="form"></div>
            <div id="subbtn" class="text-center"></div>

          </form>
        </div>
        <div class="text-center"><button type="submit" id="createForm" class="px-5 mb-5 w-100"> Create Form </button>
          <form method='post' id="logoutForm">
            <div class="text-center"><button type="submit" class="px-5 mb-5 w-100"> Logout </button>
           </form>

      </div>
    </div>
  </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
            var token = localStorage.getItem('token');

            $("#publicForm").submit(function(e)
            {
               var data = {};
                $('input').each(function (i, item)
                {
                    data[item.id] = item.value;

                });

                $.ajax({
                    type: "POST",
                    url: "api/form-store",
                    headers: {
                        Authorization: 'Bearer '+token
                    },
                    data:({
                        data : data,
                    }),
                    success: function(result)
                    {
                        location.reload();
                    }
                });
                return false;
            });

             $.ajax({
                type: "GET",
                url: "api/public-form",
                headers: {
                    Authorization: 'Bearer '+token
                },
                success: function(result)
                {
                    if (result) {
                        $.each(result, function (key, value) { 
                            $('#form').append('<div class="mb-3"><label for="name">'+value.label+ '</label><br><input type="'+value.type+'" id="'+value.value+'"></div>')
                            
                        });
                        $('#subbtn').append('<button type="submit"class="btn btn-color px-5 mb-5 w-100"> Submit </button>')
                    }
                },
                error : function (result) {
                    $('#form').append('<div class="mb-3"><p>'+result.responseJSON.error+'</p></div>')
                    // $('#subbtn').hide();
                }
            });
                

            $("#logoutForm").submit(function(event)
            {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "api/logout",
                    headers: {
                        Authorization: 'Bearer '+token
                    },
                    success: function(result)
                    {
                        window.location = '{{ url('/') }}'
                    }
                });
                return false;
            })

           $( "#createForm" ).click(function() {
              window.location = '{{ url('dynamic-form') }}'
            });

        });
       
    </script>
</body>
</html>
