<!DOCTYPE html>
<html>
<head>
    <title> @yield('title') </title>
</head>
<body>
@include('layouts.navbar')

@yield('content')

@include('layouts.footer');

</body>
</html>
