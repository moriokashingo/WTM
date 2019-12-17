@extends('layouts.app')
@section('title',"{{$tag->name}}")

@section('content')
  <h1>{{$tag->name}}の質問</h1>
    @forelse($questions as $question)
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
        @if(!$question->tags=='')
          @foreach($question->tags as $tag)
            <a href="{{route('tags.show',[$tag->id])}}" class ="btn btn-outline-secondary" >
              {{$tag->name}}
            </a>
          @endforeach
        @endif
        </div>
        @if(Auth::id() == $question->user_id)
          <a href="{{route('questions.edit',$question->id)}}" class ="btn btn-primary" >
          編集する
          </a>
        @endif
      </div>
    </div>
    @empty
    <p>no post question yet</p>
    @endforelse
@endsection
