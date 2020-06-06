@extends('layouts.layout_backend')
@section('title', 'Danh sách tài khoản')
@section('content')

    <h1>Login</h1>

    @foreach($errs as $e)
        <p style="color: red">
        @if(is_array($e))
            {{implode('<br>',$e)}}
            @else
            {{$e}}
        @endif
        </p>
    @endforeach

    <form action="" method="post">
        @csrf
        <input type="text" name="txt_username"> <br>
        <input type="password" name="txt_pwd"> <br>
        <button> Login</button>
    </form>

@endsection
