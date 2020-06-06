@extends('layouts.layout_backend')
@section('title', 'Xóa tài khoản')
@section('content')
    <h1>Xóa tài khoản</h1>
    @if($objU)
        Bạn có chắc chắn xóa tài khoản người dùng?
        <br>Username: {{$objU->username}}
        <br>Email: {{$objU->email}}
        <br>Fullname: {{$objU->fullname}}

        <form action="" method="post">
            @csrf
            <input type="checkbox" name="chk_del" value="1"> Đồng ý xóa<br>
            <button>Xóa</button>
            <a href="{{route('User.Index')}}">Không xóa</a>
        </form>
    @else
        Không xác định tài khoản cần xóa
    @endif
@endsection
