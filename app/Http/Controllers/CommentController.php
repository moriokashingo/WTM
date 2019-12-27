<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Question;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question){

        $comment= new Comment;
        $comment->body = $request->body;
        $comment->question_id = $request->question_id;
        $comment->user_id = Auth::user()->id;

        // urlをyotube用に
        $url = $request->url;

        if(strpos($url,'soundcloud.com') !== false){
            $s_url=mb_strstr($url, 'tracks/');
            $s2_url=mb_strstr($s_url, '&color',true);
            $s3_url=substr($s2_url, 7);
            $comment->url = $s3_url;
        }elseif(strpos($url,'watch') === false){
            //'$url'のなかにwatchが含まれていない場合
            $keys = parse_url($url); //パース処理
            $path = explode("/", $keys['path']); //分割処理
            $last_url = end($path); //最後の要素を取得
            $youtube ="https://www.youtube.com/embed/".$last_url;
            $comment->url = $youtube;
        }else{
            //'$url'のなかにwatchが含まれている場合
            preg_match('/v=(\w+)/', $url, $match);
            $youtube ="https://www.youtube.com/embed/".$match[1];
            $comment->url = $youtube;
        }


        $comment->save();
        return redirect()->action('QuestionController@show',['question'=>$comment->question_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question ,Comment $comment) 
    {
        //
        $login_user_id=Auth::id();
        if ($login_user_id == $question->user_id){
            return view('comment.edit')->with(['question'=>$question, 'comment'=>$comment]);
        } else {
            return redirect()->action('QuestionController@show',$question);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$question_id,$comment_id) 
    {
        //

        $comment= Comment::find($comment_id);
        $form =$request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        return redirect()->action('QuestionController@show', $question_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question ,Comment $comment)
    {
        $comment=Comment::find($comment->id);
        $login_user_id=Auth::id();
        if ($login_user_id == $comment->user_id){
            Comment::find($comment->id)->delete();
            return redirect()->action('QuestionController@show',$question);
        } else {
            return redirect()->action('CommentController@index');
        }
    }
}
