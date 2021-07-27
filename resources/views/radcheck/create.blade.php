@extends('layouts.app')
@section('title', 'Buat Username Baru')
@section('content')
<div class="wrapper">
  <h1></h1>
  <label for="" style="">Create user page. </label>
  <br> Back to <a href="{{ url('/radcheck') }}" style="color: blue">home</a>.
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
  
  <form method="POST" action="{{ url('radcheck') }}">
    @csrf
    <input name="username" type="text" placeholder="Username...">
    <button class="btn-blue">Submit</button>
  </form>

</div>
@endsection