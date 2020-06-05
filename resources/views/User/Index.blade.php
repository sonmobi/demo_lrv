@extends('layouts.layout_backend')
@section('title', 'Danh sách tài khoản')
@section('content')

<h1>Danh sách User</h1>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Fullname</th>
        <th>Action</th>
    </tr>
    @forelse($listU as $objU)
    <tr>
        <td>{{$objU->id}}</td>
        <td> <a href="{{route('User.Edit',['id'=>$objU->id])}}">  {{$objU->username}} </a></td>
        <td>{{$objU->email}}</td>
        <td>{{$objU->fullname}}</td>
        <td><a href="{{route('User.Delete',['id'=>$objU->id])}}">Xóa</a></td>
    </tr>
        @empty
            <tr>
                <td colspan="4" align="center">
                    Danh sách trống
                </td>
            </tr>
        @endforelse
</table>
<a href="{{route('User.Add')}}">Thêm mới</a>
@endsection
