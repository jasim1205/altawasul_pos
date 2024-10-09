<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Altawasul-Login</title>

    <link
      rel="shortcut icon"
      href="{{asset('public/assets/compiled/svg/favicon.svg')}}"
      type="image/x-icon"
    />
  
    <link rel="stylesheet" href="{{asset('public/assets/compiled/css/app.css')}}" />
    <link rel="stylesheet" href="{{asset('public/assets/compiled/css/app-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('public/assets/compiled/css/auth.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
      *{
        overflow: hidden;
      }
    </style>
  </head>

  <body>
    <script src="{{asset('public/assets/static/js/initTheme.js')}}"></script>
    <div>
      <div class="row">
        @yield('content')
      </div>
    </div>
  </body>
		<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
</html>
