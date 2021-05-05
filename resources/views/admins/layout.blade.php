<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SEWA</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">

    <div class="text-center" style="margin: 50px 0 50px 0;"><a href="{{url("products")}}"><img
                src="{{asset("logo.png")}}" alt="Logo"></a><br>Espace SEWACARD
    </div>

    @yield('content')
</div>

</body>
</html>