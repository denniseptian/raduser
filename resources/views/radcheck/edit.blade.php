@extends('layouts.app')
@section('title', 'Rad Edit')
@section('content')
<div class="wrapper">
  <h1></h1>
  Edit page. Back to <a href="{{ url('/radcheck') }}" style="color: blue">home</a>.
  @if (session('success'))
  <br>
  <div class="alert-success">
    <p>{{ session('success') }}</p>
  </div>
  @endif
  
  @if ($errors->any())
  <div class="alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  
  <form method="POST" action="{{ url('radcheck', $raddata->id ) }}">
    @csrf
    @method('PUT')
    <input name="username" value="{{ $raddata->username }}" type="text" placeholder="Title...">
    <button class="btn-blue">Submit</button>
  </form>
</div>
@endsection