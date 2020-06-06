<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        $dataView = [ 'errs' => [] ];
        if ($request->isMethod('post')) {
            // Hãy viết lệnh kiểm tra hợp lệ dữ liệu trước khi login nhé....
            // viết lệnh kiểm tra hợp lệ dữ liệu ở đây....
            $rule = [
                'txt_username'=>'required',
                'txt_pwd'=>'required'// hãy sửa thêm các luật khác để kiểm tra chặt chẽ hơn
            ];
            $validator = Validator::make($request->all(), $rule);

            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
            }else{
                //  login
                $dataLogin = [
                    'username' => $request->get('txt_username'),
                    'password' => $request->get('txt_pwd')
                ];

                if (Auth::attempt($dataLogin)) {
                    // login thanh cong
                    echo "OK dang nhap thanh cong, thong tin user: ";
                    echo '<pre>';
                    print_r(Auth::user());
                    echo '</pre>';
                    // Lấy id tài khoản đã đăng nhập;
                    echo '<br>ID tai khoan = ' . Auth::id();

                    // Chuyển về trang chủ
//            return redirect()->intended('dashboard');
                } else {
                    $dataView['errs'][] = 'Sai tên đăng nhập hoặc sai password!';
                }
            }
        }

        return view('Auth.Login', $dataView);
    }

    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('Auth.Login');
    }
}
