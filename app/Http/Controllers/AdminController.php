<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Upload(Request $request){
        $dataView = [];

        if($request->isMethod('post')){

            $file = $request->file('f_upload');
            // lấy danh sách đuôi file hợp lệ đã định nghĩa trong config
            $file_allow_upload = config('app.file_allow_upload');
            if(!in_array($file->getClientMimeType(), $file_allow_upload))
            {
                echo 'Bạn chỉ có thể upload các file dạng: ' .implode('; ',$file_allow_upload);
                die( );
            }


            // đưa thông tin ra view:
            $file_info = new \stdClass();
            $file_info->name = $file->getClientOriginalName();
            $file_info->extension = $file->getClientOriginalExtension();
            $file_info->path = $file->getRealPath();
            $file_info->size = $file->getSize();
            $file_info->mime = $file->getMimeType();


            //di chuyển file từ thư mục tạm vào thư mục lưu trữ trong /public để xem ảnh dạng web
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());

            // dùng cái link dưới đây để lưu vào CSDL nhé.
            $file_info->link_img = '/uploads/'.$file->getClientOriginalName();

            $dataView['file_info'] = $file_info;
        }

        return view('Admin.Upload', $dataView);
    }
}
