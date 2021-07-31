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
  <div class="row">
    <div class="col-sm-4">
      <form method="POST" action="{{ url('radcheck') }}">
        @csrf
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="11600XXXX">
          <small id="username" class="form-text text-muted">Masukkan kode yang di dapat dari web manage.</small>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
  

</div>
@endsection