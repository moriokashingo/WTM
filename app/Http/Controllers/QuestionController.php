<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Question;
use App\Comment;
use App\Tag;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions =Question::latest()->paginate(2);
        return view('questions.index',['questions'=>  $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = $request->validate([
            'description' => 'required',
            'user_id'     =>  'required|numeric',
        ]);
        $question = new question;
        $question->description = $request->description;
        $question->resolution = $request->resolution;
        $question->user_id = Auth::user()->id;
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]);
            array_push($tags,$record);
        };
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        $question->save();
        $question->tags()->attach($tags_id);
        return redirect('/');
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
        $question = Question::findOrFail($id);
        $comments = Comment::latest()->paginate(5);
        return view('questions.show')->with(['question'=>$question ,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
        $login_user_id=Auth::id();
        if ($login_user_id == $question->user_id){
            return view('questions.edit')->with('question',$question);
        } else {
            return redirect()->action('QuestionController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $this->validate($request, Question::$rules);
        $question= Question::find($id);
        $form =$request->all();
        unset($form['_token']);
        $question->fill($form)->save();
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $question=Question::find($id);
        $login_user_id=Auth::id();
        if ($login_user_id == $question->user_id){
            Question::find($id)->delete();
            return redirect('/');
        } else {
            return redirect()->action('QuestionController@index');
        }

    }
}
