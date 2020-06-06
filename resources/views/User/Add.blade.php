@extends('layouts.layout_backend')
@section('title', 'Thêm mới tài khoản')
@section('content')
    <h1>Thêm User mới</h1>
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
        Username: <input type="text" name="txtUsername"><br>
        Password: <input type="password" name="txtPassword"><br>
        Email: <input type="email" name="txtEmail"><br>
        Fullname: <input type="text" name="txtFullname"><br>
        <button>Save New</button>
    </form>
@endsection
