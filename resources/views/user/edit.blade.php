@extends('layouts.app')
@section('title','ユーザー情報の編集')

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
  ユーザー情報の編集
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
<div>
  @if(!empty($auth->thumbnail))
    <img src="/storage/user/{{ $auth->thumbnail }}" class="thumbnail">
  @else
    画像なし
  @endif
</div>
<form action="{{ url('users/'. $auth->id)}}" method="post" enctype="multipart/form-data" id="form">
  {{csrf_field()}}
  {{ method_field('patch') }}
  <input type="hidden" name='user_id' value={{ $auth->id }}>
  <label for="thumbnail">Thumbnail</label>
  <input type="file" name="thumbnail" value=""/>>
  <label for="name">name</label>
  <input type='text' name='name' value="{{old('name', $auth->name)}}">
  <label for="email">email</label>
  <input type='text' name='email' value="{{old('email', $auth->email)}}">
  <label for="password">password</label>
  <input type='text' name='password'>
  <label for="password_confirmation">password_confirmation</label>
  <input type='text' name='password_confirmation' >
  <input type="submit" value="Update">
  <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">戻る</a>
  </p>
</form>
@endsection
