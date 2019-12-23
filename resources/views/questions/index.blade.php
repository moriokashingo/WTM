@extends('layouts.app')
@section('title',"WTM~ What's The Music?~")

@section('content')
<h1>Question's</h1>
  @if(isset($search_query )|| isset($tag_search_query ))
    <h5 class='card-title'>{{$seacrh_result}}</h5>
  @endif
  <form action="{{route('questions.search')}}" method='get' class="form-inline md-form mr-auto mb-4">
      {{csrf_field()}}
      <h5 class="card-title">文章検索フォーム</h5>
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-outline-secondary btn-sm my-0" type="submit">Search</button>
  </form>
  <form action="{{route('tags.search')}}" method='get' class="form-inline md-form mr-auto mb-4">
      {{csrf_field()}}
      <h5 class="card-title">タグ検索フォーム</h5>
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-outline-secondary btn-sm my-0" type="submit">Search</button>
  </form>
    @foreach($questions as $question)
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
          <a href="{{route('questions.show',$question->id)}}">
          {{ $question->description }}
          </a>
        </h5>
        @isset($question->url)
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ $question->url  }}" allowfullscreen></iframe>
          </div>
        @endisset
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

        @if(Auth::id() == $question->user_id)
          <a href="{{route('questions.edit',$question->id)}}" class ="btn btn-primary" >
          編集する
          </a>
        @endif
      </div>
    </div>
    @endforeach
    @if(isset($tag_search_query))
        {{$questions->appends(['tag_search_query'=> $tag_search_query])->links()}}
    @elseif(isset($search_query))
        {{ $questions->appends(['search_query'=>$search_query])->links() }}
    @else
        {{$questions->links()}}
    @endif
@endsection
