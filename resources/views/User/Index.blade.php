<h1>Danh sách User</h1>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Fullname</th>
    </tr>
    @forelse($listU as $objU)
    <tr>
        <td>{{$objU->id}}</td>
        <td>{{$objU->username}}</td>
        <td>{{$objU->email}}</td>
        <td>{{$objU->fullname}}</td>
    </tr>
        @empty
            <tr>
                <td colspan="4" align="center">
                    Danh sách trống
                </td>
            </tr>
        @endforelse
</table>
