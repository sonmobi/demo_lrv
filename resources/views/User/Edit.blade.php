@extends('layouts.layout_backend')
@section('title', 'Sửa tài khoản')
@section('content')

    <h1>Sửa thông tin User</h1>
    @isset($msg)
        <p style="color: green">{{$msg}}</p>
    @endisset
    @isset($errs)
        @foreach($errs as $e)
            <p style="color: red"> {{  implode('<br>', $e ) }}  </p>
        @endforeach
    @endisset

    <form action="" method="post">
        @csrf
        Username: <input type="text" name="txtUsername" value="{{$objU->username}}" disabled><br>
        Password: <input type="password" name="txtPassword" value=""><br>
        Email: <input type="email" name="txtEmail" value="{{$objU->email}}" disabled><br>
        Fullname: <input type="text" name="txtFullname" value="{{$objU->fullname}}"><br>
        <button>Save Update</button>
    </form>

@endsection
