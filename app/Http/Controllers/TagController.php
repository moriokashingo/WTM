<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Auth;
use App\Question;
use App\Comment;
use App\Tag;

class TagController extends Controller
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
    public function search(Request $request)
    {
        //

        $tags = Tag::with('questions')->where('name','like',"%$request->search%")->paginate(2);
        $a_questions=[];
        foreach ($tags as $tag){
            foreach ($tag->questions as $question){
                array_push($a_questions,$question);
            }
        }

        $questions = new Paginator($a_questions, 2 );
        $seacrh_result= $request->search."の検索結果".count($a_questions)."件";
        return view('questions.index',[
            'seacrh_result'=>$seacrh_result,
            'questions'  =>$questions,
            'tag_search_query'=>$request->search
            ]);
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
    public function store(Request $request)
    {
        //
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
        $tag = Tag::find($id);
        $questions = $tag->questions;
        // dd($tag->questions);
        return view('tag.show',['questions'=>  $questions,'tag'=>$tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
