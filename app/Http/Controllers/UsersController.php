<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User; //この行を追記
use Intervention\Image\Facades\Image; //追加

use App\Services\CheckExtensionServices; //追加
use App\Services\FileUploadServices; //追加
use App\Http\Requests\ProfileRequest;
class UsersController extends Controller
{
    //ここから追記
    public function show($id)
    {
        $user = User::findorFail($id);

        //dd($user); //削除

        return view('users.show', compact('user')); //変更
    }
    // ここから追加
    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit', compact('user')); 
    }

    public function update($id, ProfileRequest $request) //ここを編集
    {

        $user = User::findorFail($id);

        if(!is_null($request['img_name'])){
            $imageFile = $request['img_name'];

            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;
            
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            $image = Image::make($data_url);        
            $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

            $user->img_name = $fileNameToStore;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->self_introduction = $request->self_introduction;

        $user->save();

        return redirect()->to('home'); 
    }


}
    // ここまで追加
}
