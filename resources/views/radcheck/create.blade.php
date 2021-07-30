@extends('layouts.app')
@section('title', 'Buat Username Baru')
@section('content')
<div class="wrapper">
  <nav class="nav">
    <a class="nav-link active" style="font-weight: bold" aria-current="page" href="{{ url('/radcheck') }}"><i class="fas fa-arrow-circle-left"></i> BACK</a>
    <a class="nav-link">Create a new user</a>
  </nav>
  <label for=""></label><br>
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