<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body style="font-family: 'Arial, Helvetica, sans-serif';margin: 30px;margin-right: 30px ">
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center mt-5">Form Data</h2>
            @foreach(json_decode($forms->user_datas) as $key => $data)
            <div class="mb-3">
            <p class="form-control text-center">Your {{ ucfirst($key) }} - {{ $data }}</p>
            </div>
            @endforeach

            <h3 class="text-center mt-5">Thank You.</h3>
    </div>
  </div>
</body>
</html>