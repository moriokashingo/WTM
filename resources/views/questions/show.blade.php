@extends('layouts.app')
@section('title',$question->body)

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
      <a href="#">
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
  </div>
</div>
@if(Auth::id() == $question->user_id)
<form action="{{route('questions.destroy',$question->id)}}" method="post">
  {{ csrf_field() }}
  {{ method_field('delete') }}
  <input type="hidden" name="id" value="{{$question->id}}">
  <input type="submit" value="削除">
</form>
@endif

@endsection

