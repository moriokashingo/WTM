@extends('layouts.app')
@section('title','Create Question')

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
  Create Question
</h1>
<form method="post" action="{{route('questions.store')}}">
  {{csrf_field()}}
  <p>
    <textarea name="description" placeholder ="質問の内容を書き込んでください" style='width:100%;min-height:300px;'>{{old('body')}}</textarea>
    @if($errors->has('description'))
    <span class="error">{{$errors->first('description')}}</span>
    @endif
    <input type='hidden' name='user_id' value={{Auth::id()}}>
    <input type='hidden' name='resolution' value="false">
  </p>
  <p>
    <input type="submit" value="投稿する">
  </p>
</form>
@endsection
