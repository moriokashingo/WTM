<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use  Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
    public function index(Request $request)
    {
        //
        $q = \Request::query();
        $id = $request->query('page');

        if(isset($q["tag_search_query"])){
            $tag_search_query=$q["tag_search_query"];
            $tags = Tag::with('questions')->where('name','like',"%$tag_search_query%")->get();
            $a_questions=[];
            foreach ($tags as $tag){
                foreach ($tag->questions as $question){
                    array_push($a_questions,$question);
                }
            }
            $total= count($a_questions);

            $perPage = 2;
            $page = max(0,Paginator::resolveCurrentPage() - 1);
            $sliced = array_slice($a_questions, $page * $perPage, $perPage);
            $questions = new LengthAwarePaginator(
                $sliced,
                $total,
                2,
                $id );

            $seacrh_result= $tag_search_query."のタグ検索結果".count($a_questions)."件";
            return view('questions.index',[
                'seacrh_result'=>$seacrh_result,
                'questions'  =>$questions,
                'tag_search_query'=>$tag_search_query
                ]);
        } else{
            $questions =Question::latest()->paginate(2,['*'],'page',$id);
            return view('questions.index',['questions'=>  $questions]);
        }
    }
    public function search(Request $request)
    {
        //
        $q = \Request::query();
        $id = $request->query('page');
        if(isset($q["search_query"])){
            $search_query= $q["search_query"];
            $questions = Question::where('description','like',"%$search_query%")
            ->paginate(3,['*'],'page',$id);
            $seacrh_result= $search_query."の文章検索結果".$questions->total()."件";
            return view('questions.index',[
                'seacrh_result'=>$seacrh_result,
                'questions'  =>$questions,
                'search_query'=>$search_query
                ]);
        }else{
            $questions = Question::where('description','like',"%$request->search%")
            ->paginate(3);
            $seacrh_result= $request->search."の文章検索結果".$questions->total()."件";
            return view('questions.index',[
                'seacrh_result'=>$seacrh_result,
                'questions'  =>$questions,
                'search_query'=>$request->search
                ]);
        }
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

        // urlをyotube用に
        $url = $request->url;
        if(strpos($url,'soundcloud.com') !== false){
            $s_url=mb_strstr($url, 'tracks/');
            $s2_url=mb_strstr($s_url, '&color',true);
            $s3_url=substr($s2_url, 7);
            $question->url = $s3_url;
        }elseif(strpos($url,'watch') === false){
            //'$url'のなかにwatchが含まれていない場合
            $keys = parse_url($url); //パース処理
            $path = explode("/", $keys['path']); //分割処理
            $last_url = end($path); //最後の要素を取得
            $youtube ="https://www.youtube.com/embed/".$last_url;
            $question->url = $youtube;
        }else{
            //'$url'のなかにwatchが含まれている場合
            preg_match('/v=(\w+)/', $url, $match);
            $youtube ="https://www.youtube.com/embed/".$match[1];
            $question->url = $youtube;
        }


        // タグの処理
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
        $comments = Comment::where("question_id",$id)->paginate(5);
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
