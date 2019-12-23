@extends('layouts.app')
@section('title','Edit Question')

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
  Edit post
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
<form action="{{ url('questions/'. $question->id)}}" method="post">
  {{csrf_field()}}
  {{ method_field('patch') }}
  <p>
    <textarea name="url" placeholder ="動画のurlを書き込んでください" style='width:100%;'>{{old('url', $question->url)}}</textarea>
    <textarea name="description" placeholder ="質問内容を入力してください" style='width:100%;min-height:300px;' >{{old('description', $question->description)}}</textarea>
    @if($errors->has('description'))
    <span class="error">{{$errors->first('description')}}</span>
    @endif
  </p>
  <input type='hidden' name='user_id' value="{{old('user_id', $question->user_id)}}">
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
