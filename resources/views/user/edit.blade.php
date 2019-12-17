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
<form action="{{ url('users/'. $auth->id)}}" method="post">
  {{csrf_field()}}
  {{ method_field('patch') }}
  <label for="name">name</label>
  <input type='text' name='name' value="{{old('name', $auth->name)}}">
  <label for="email">email</label>
  <input type='text' name='email' value="{{old('email', $auth->email)}}">
  <label for="password">password</label>
  <input type='text' name='password'>
  <label for="password_confirmation">password_confirmation</label>
  <input type='text' name='password_confirmation' >
  <input type="submit" value="Update">
  </p>
</form>
@endsection
