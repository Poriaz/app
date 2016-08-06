<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<title>Business Development</title>

<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->
<!--link href="{{ URL::asset('public/assets/css/navbar-fixed-top.css') }}" rel="stylesheet"-->
<link href="{{ URL::asset('public/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/assets/css/font.css') }}" rel="stylesheet">
<style>
    .wrapper {
    margin-top: 0px !important;
}
body{
    padding-top:0px !important;
}
</style>
</head>
<body>
    
     @yield('content')
</body>
</html>