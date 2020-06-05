<h1>Demo Upload file</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="f_upload"> <button>Start Upload</button>
    @csrf
</form>

@isset($file_info)
<hr>
<h2>Thông tin ảnh </h2>
File Name: {{$file_info->name}}; <br>
File Extension: {{$file_info->extension}} <br>
File Temp Path: {{$file_info->path}} <br>
File Size: {{$file_info->size}} bytes <br>
File Mime Type: {{$file_info->mime}} <br>
Link: {{$file_info->link_img}} <br>

    @if(strpos($file_info->mime,'image')!==false)
        <img src="{{asset($file_info->link_img)}}" />
    @endif

@endisset
