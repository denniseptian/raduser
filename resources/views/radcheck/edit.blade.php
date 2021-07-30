@extends('layouts.app')
@section('title', 'Rad Edit')
@section('content')
<div class="wrapper">
  <h1></h1>
  Edit page. Back to <a href="{{ url('/radcheck') }}" style="color: blue">home</a><br>
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
  @foreach ($raddata as $rad)
    @if ($rad->attribute == "Cleartext-Password")
    {{-- <form method="POST" action="{{ url('radcheck', $rad->id ) }}"> --}}
      {{-- @csrf --}}
      {{-- @method('PUT') --}}
        <label for="username">Username</label>
        <input id="username" name="username" value="{{ $rad->username }}" type="text" placeholder="Title..." disabled><br>
        <label for="password">password</label>
        <input type="text" name="password" id="password" value="{{ $rad->value }}" placeholder="Password" disabled>
        {{-- <button class="btn-blue">Submit</button> --}}
    {{-- </form>  --}}
    @elseif ($rad->attribute == "User-Profile")
    <form method="POST" action="{{ url('radcheck', $rad->id ) }}">
      @csrf
      @method('PUT')
        <label for="value" tabindex="2">Profile</label>
        <select name="value" id="value">
          @if ($rad->value == "expired")
            <option value="expired" selected>expired</option>
            <option value="active">active</option>
          @elseif ($rad->value == "active")
            <option value="expired">expired</option>
            <option value="active" selected>active</option>
          @endif
        </select>
        {{-- <input id="profile" name="profile" value="{{ $rad->value }}" type="text" placeholder="Title..."> --}}
        <button class="btn-blue">Submit</button>
    </form> 
    @endif     
  @endforeach
  
</div>
@endsection
