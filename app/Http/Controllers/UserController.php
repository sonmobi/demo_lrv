<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function Index(){
        // viết code cho action ở đây
        $dataView = [];
        $objModelU = new User();
        $dataView['listU'] = $objModelU->GetList();
        return view('User.Index',$dataView);
    }

    /**
     * @param Request $request  tham số này sẽ dùng để nhận dữ liệu post từ form lên
     */
    public function Add(Request $request){
        $dataView = ['errs'=>[] ]; // mảng để truyền dữ liệu ra view

        if($request->isMethod('post')){
            //1. Viết lệnh kiểm tra hợp lệ dữ liệu
            // viết luật kiểm tra, tham khảo https://laravel.com/docs/7.x/validation#available-validation-rules
            $rule = [
                'txtUsername' =>'required|regex:/^[0-9a-zA-Z]{5,30}$/',
                'txtPassword'=>'required',
                'txtEmail'=>'required',
                'txtFullname'=>'required'
            ];
            // viết lại câu thông báo thành tiếng Việt
            $msgE = [
                'txtUsername.required' =>'Bạn cần nhập Username',
                'txtUsername.regex'=>'Username chỉ nhập chữ cái hoặc số từ 5 đến 30 ký tự',
                'txtPassword.required'=>'Bạn cần nhập Password',
                'txtEmail.required'=>'Bạn cần nhập Email',
                'txtFullname.required'=>'Bạn cần nhập Họ tên'
            ];
            // bắt đầu kiểm tra
            $validator = Validator::make($request->all(), $rule, $msgE);
            // check có lỗi hay không
            if($validator->fails())
                $dataView['errs'] = $validator->errors()->toArray();
            else{
                // không có lỗi, ghi CSDL
                $dataSave = [
                    'username' => $request->get('txtUsername'),
                    'passwd' => $request->get('txtPassword'),
                    'email' => $request->get('txtEmail'),
                    'fullname' => $request->get('txtFullname')
                ];

                $objModel = new User(); // tạo đối tượng để gọi hàm SaveNew
                $newID = $objModel->SaveNew($dataSave);

                if($newID>0){
                    // có thể bạn truyền ra view thì
//                    $dataView['msg'] = 'Thêm mới thành công!';
                    // hoặc bạn chuyển về trang danh sách
                    return redirect()->route('User.Index');

                }

                else
                    $dataView['errs'][] = ['Không ghi được CSDL!'];

                // truyền id mới ra view, nếu ghi được thì id >0, ở view sẽ kiểm tra
            }
        }

        return view('User.Add', $dataView);
    }

    /**
     * @param $id   tham số này nhận giá trị ở trên url
     * @param Request $request   tham số này sẽ dùng để nhận dữ liệu post từ form lên
     */
    public function Edit($id, Request $request){
        $dataView = ['errs'=>[] ];

        // lấy thông tin User để hiển thị ra form
        $objU = User::where('id',$id)->first();
        $dataView['objU'] = $objU;


        if($request->isMethod('post')){
            //1. Viết lệnh kiểm tra hợp lệ dữ liệu
            // viết luật kiểm tra, tham khảo https://laravel.com/docs/7.x/validation#available-validation-rules
            $rule = [
//                'txtUsername' =>'required|regex:/^[0-9a-zA-Z]{5,30}$/',
                'txtPassword'=>'nullable|min:5', // cho phép trống rỗng
//                'txtEmail'=>'required',
                'txtFullname'=>'required'
            ];
            // viết lại câu thông báo thành tiếng Việt
            $msgE = [
//                'txtUsername.required' =>'Bạn cần nhập Username',
//                'txtUsername.regex'=>'Username chỉ nhập chữ cái hoặc số từ 5 đến 30 ký tự',
                'txtPassword.min'=>'Bạn cần nhập Password ít nhất 5 ký tự',
//                'txtEmail.required'=>'Bạn cần nhập Email',
                'txtFullname.required'=>'Bạn cần nhập Họ tên'
            ];
            // bắt đầu kiểm tra
            $validator = Validator::make($request->all(), $rule, $msgE);
            // check có lỗi hay không
            if($validator->fails()){
                $dataView['errs'] = $validator->errors()->toArray();
            }
            else{
                // không có lỗi, ghi CSDL
                $dataSave = [
                    // thường thì không cho sửa username và email.
//                    'username' => $request->get('txtUsername'),
//                    'email' => $request->get('txtEmail'),
                    'fullname' => $request->get('txtFullname')
                ];

                // nếu có sửa pass thì mới cập nhật
                if( strlen($request->get('txtPassword'))>0){
                    $dataSave['passwd'] = $request->get('txtPassword');
                }

                $objModel = new User(); // tạo đối tượng để gọi hàm SaveNew
                $rowUpdate = $objModel->SaveUpdate($id,$dataSave);

                if($rowUpdate>0){
                    // có thể bạn truyền ra view thì
//                    $dataView['msg'] = 'Cập nhật thành công!';
                    // hoặc bạn chuyển về trang danh sách
                    return redirect()->route('User.Index');
                }
                else
                    $dataView['errs'][] = ['Không có gì cập nhật!'];

            }
        }

        return view('User.Edit', $dataView);
    }

    public function Delete($id, Request $request){
        $dataView = [ 'errs'=>[]];
        // lấy thông tin User để hiển thị ra form
        $objU = User::where('id',$id)->first();
        $dataView['objU'] = $objU;

        if($request->isMethod('post')){
            $chk = $request->get('chk_del');
            if(!empty($chk)){
                $objU->delete();
                return redirect()->route('User.Index');
            }
        }
        return view('User.Delete', $dataView);
    }
}
