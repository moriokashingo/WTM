@extends('layouts.app')
@section('title','Edit Question')

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
  Edit Comment
</h1>
@if (count($errors) > 0)
  <div>
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<form action="{{route('questions.comments.update',[$question->id ,$comment->id])}}" method="post">
  {{csrf_field()}}
  {{ method_field('patch') }}
  <p>
    <textarea name="body" placeholder ="質問内容を入力してください" style='width:100%;min-height:300px;' >{{old('body', $comment->body)}}</textarea>
    @if($errors->has('body'))
    <span class="error">{{$errors->first('body')}}</span>
    @endif
  </p>
  <input type='hidden' name='user_id' value="{{old('user_id', $comment->user_id)}}">
  <input type='hidden' name='question_id' value="{{old('question_id', $comment->question_id)}}">
  @if($question->resolution=="0")
  <input type="hidden" name="resolution" value="0" >
  @else
  <input type="hidden" name="resolution" value="1" >
  @endif
  <p>
    <input type="submit" value="Update">
  </p>
</form>
@endsection
