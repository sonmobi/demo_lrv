<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'passwd',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';
    public function GetList($params = []){
        $query = DB::table($this->table);
        //các lệnh thêm cho truy vấn viết ở đây
        //......
        $query->orderBy('id','desc');

        // thực thi lệnh lấy dữ liệu
        $list = $query->get();
        return $list;
    }

    public function SaveNew($data){

        return DB::table($this->table)->insertGetId($data);
    }

    public function SaveUpdate($id, $data){
        return DB::table($this->table)
                    ->where('id',$id)
                    ->update($data);
    }

    /**
     * mặc định tên cột trong bảng user phải là password, nếu thay đổi
     * thì bạn có thể dùng hàm này để return lại tên cột
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->passwd;
    }

    /**
     * Hàm lấy danh sách tất cả các vai trò (giống như nhóm tài khoản)
     */
    public function role(){
        return $this->belongsTo(Role::class, 'id_role','id');
    }

    // hàm kiểm tra user hiện tại có được gán 1 quyền nào đó hay không,
    // nếu có thì trả về true
    public function hasPermission(Permission $permission){
//        echo $permission->name;

        $check = !!optional(optional($this->role)->permission)->contains($permission);
//        var_dump($check);
//        die();
        return $check;
    }
}
