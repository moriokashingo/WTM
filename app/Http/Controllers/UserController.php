<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller

{
    //
    public function index(){

        $auth =Auth::user();
        return view('user.index',["auth"=>$auth]);
    }
    public function edit($id){

        $auth =Auth::user();
        return view('user.edit',["auth"=>$auth]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),User::$editRules);
        $uploadfile = $request->file('thumbnail');
        if(!empty($uploadfile)){

            $thumbnailname = $request->file('thumbnail')->hashName();
            $request['password'] = Hash::make($request['password']);
            $request->file('thumbnail')->storeAs('public/user', $thumbnailname);
            $param = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'thumbnail'=>$thumbnailname,
            ];
        }else{
            $request['password'] = Hash::make($request['password']);
            $param = [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
            ];
        }
        $user = User::find($request->user_id)->update($param);
        return redirect()->route('users.index');

    }
    public function show($id)
    {
        //
        $questions =Question::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(2);
        return view('user.show',['questions'=>  $questions]);
    }
}
