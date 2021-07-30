@extends('layouts.app')
@section('title', 'Buat Username Baru')
@section('content')
<div class="wrapper">
  <nav class="nav">
    <a class="nav-link active" style="font-weight: bold" aria-current="page" href="{{ url('/radcheck') }}"><i class="fas fa-arrow-circle-left"></i> BACK</a>
  </nav>
  <label for="">---------------------------------------</label><br>
  <label style="font-weight: bold" for="">Create new user.</label><br>
  <label for="">ex: 116009000</label><br>
  <label for="">---------------------------------------</label><br>
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