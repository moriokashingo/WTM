@extends('layouts.app')
@section('title','Create Question')

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
  Create Question
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
<form method="post" action="{{route('questions.store')}}">
  {{csrf_field()}}
  <textarea name="url" placeholder ="動画のurlを書き込んでください" style='width:100%;'>
      {{old('url')}}
    </textarea>
  <textarea name="description" placeholder ="質問の内容を書き込んでください" style='width:100%;min-height:300px;'>
    {{old('body')}}
  </textarea>
  @if($errors->has('description'))
    <span class="error">{{$errors->first('description')}}</span>
  @endif
  <label for="tags">
      タグ
  </label>
  <input　id="tags"　name="tags"　value="{{ old('tags') }}"　type="text">
  @if ($errors->has('tags'))
      <div class="invalid-feedback">
          {{ $errors->first('tags') }}
      </div>
  @endif
  <input type='hidden' name='user_id' value={{Auth::id()}}>
  <input type='hidden' name='resolution' value="false">
  <input type="submit" value="投稿する">
</form>
@endsection
