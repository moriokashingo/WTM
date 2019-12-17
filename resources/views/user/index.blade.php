@extends('layouts.app')
@section('title',"ユーザー情報")

@section('content')
<h1>
  <a href="{{url('/')}}" class="header-menu">BACK</a>
</h1>
<div class="card">
  <div class="card-body">
    <p class="card-title">name:{{$auth->name}}</p>
    <p class="card-title">email:{{$auth->email}}</p>
  </div>
<a href="{{route('users.edit',$auth->id)}}" class ="btn btn-primary" >
  編集する
</a>
</div>


@endsection

