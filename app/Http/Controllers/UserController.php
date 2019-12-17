<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Question;
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
        $this->validate($request, User::$editRules);
        $auth =Auth::user();
        $form = $request->all();
        unset($form['_token']);
        foreach ($form as $key => $value) {
            // nullの場合更新対象から除外する
            if($value == null) {
            unset($form[$key]);
            }
        }
        // パスワードを暗号化する
        $form['password'] = Hash::make($form['password']);
        $auth->fill($form)->save();
        return view('user.index',["auth"=>$auth]);
    }
    public function show($id)
    {
        //
        $questions =Question::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(2);
        return view('user.show',['questions'=>  $questions]);
    }
}
