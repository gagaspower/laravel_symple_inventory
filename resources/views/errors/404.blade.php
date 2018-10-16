<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Page not found</title>
    <link href="{{asset('template/error/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('template/error/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/error/css/font-awesome.css')}}" rel="stylesheet">
  </head>

  <body>

  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <h1> 404</h1>
        <h2>Oops... Page Not Found!</h2>

        <p><a href="/">Go Back Home</a></p>

     </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          &copy; <?php echo date("Y");?> All Rights Reserved 
        </div>
      </div>
    </div>
  </footer>
    <script src="{{asset('template/errorjs/jquery.js')}}"></script>
    <script src="{{asset('template/errorjs/bootstrap.js')}}"></script>
  </body>
</html>
