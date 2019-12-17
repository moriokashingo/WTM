@extends('layouts.app')
@section('title',$question->description)

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
</h1>
<!-- 改行をbrタグに変更 -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">
      <a href="{{route('questions.show',$question->id)}}">
      {{$question->description}}
      </a>
    </h5>
    <h5 class="card-title">
      投稿者:
      <a href="{{route('users.show',[$question->user_id])}}">
        {{$question->user->name}}
      </a>
    </h5>
    <div class="resolution">
      @if($question->resolution=="0")
        <div class="resolution__still">
        未解決
        </div>
      @else
        <div class="resolution__already">
        解決済み
        </div>
      @endif
    </div>
    @if(!$question->tags=='')
      @foreach($question->tags as $tag)
        <a href="{{route('tags.show',[$tag->id])}}" class ="btn btn-outline-secondary" >
          {{$tag->name}}
        </a>
      @endforeach
    @endif
  </div>
</div>
@if(Auth::id() == $question->user_id)
<form action="{{route('questions.destroy',$question->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('delete') }}
  <input type="hidden" name="id" value="{{$question->id}}">
  <input type="submit" value="削除" class="btn btn-primary">
</form>
@endif
<div class="comment__box">
  <h2>Comments</h5>
  @forelse($comments as $comment)
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          {{$comment->body}}
        </h5>
        <h5 class="card-title">
          投稿者:
          <a href="{{route('users.show',[$comment->user_id])}}">
            {{$comment->user->name}}
          </a>
        </h5>
        <p class="card-title">
          投稿時間:{{$comment->updated_at}}
        </p>
      </div>
    </div>
    @if(Auth::id() == $comment->user_id)
    <form action="{{route('questions.comments.destroy',[$question->id ,$comment->id])}}" method="post">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <input type="hidden" name="id" value="{{$question->id}}">
      <input type="submit" value="削除" class='btn btn-primary'>
    </form>
    <a href="{{route('questions.comments.edit',[$question->id ,$comment->id])}}" class ="btn btn-primary" >
          編集
          </a>
    @endif
  @empty
  <p>no comments yet</p>
  @endforelse
{{$comments->links()}}
<form method="post" action="{{action('CommentController@store',$question)}}">
  {{csrf_field()}}
  <p>
    <input type="text" name="body" placeholder="enter comment" value="{{old('body')}}" style='width:100%; height:50px;'>
    <input type='hidden' name='user_id' value={{Auth::id()}}>
    <input type='hidden' name='question_id' value="{{$question->id}}">

    @if($errors->has('body'))
    <span class="error">{{$errors->first('body')}}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="add comment">
  </p>
</form>
</div>

@endsection

