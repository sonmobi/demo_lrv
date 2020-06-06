<!DOCTYPE html>
<html>
<head>
    <title> @yield('title') </title>
</head>
<body>
@if (Auth::check())
    <h3>Chào bạn {{Auth::user()->email}}</h3>
    <a href="{{route('Auth.Logout')}}">Đăng xuất</a>
@else
    <h3> <a href="{{route('Auth.Login')}}">Đăng nhập</a> </h3>
@endif

@include('layouts.navbar')

@yield('content')

@include('layouts.footer');

</body>
</html>
