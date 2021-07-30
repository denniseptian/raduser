@extends('layouts.app')
@section('title', 'Rad Edit')
@section('content')
<div class="wrapper">
  <nav class="nav">
    <a class="nav-link active" style="font-weight: bold" aria-current="page" href="{{ url('/radcheck') }}"><i class="fas fa-arrow-circle-left"></i> BACK</a>
  </nav>
  <label for="">---------------------------------------</label><br>
  <label for="">Edit page for {{ $raddata[0]['username']}}</label><br>
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
  {{-- {{ print_r($mrResponse['after']['ret']) }} --}}
  @if ($mrResponse != false)
    {{-- {{ print_r(explode(';',$mrResponse['after']['ret'])) }} --}}
    <label for="pppinform">PPP</label>
    <input type="text" style="color:green; font-weight:bold;" name="pppinform" id="pppinform" value="Connected!" disabled><br>
    <label for="address">Address</label>
    <input disabled type="text" id="address" name="address" style="" value="{{ str_replace('address=','',explode(';',$mrResponse['after']['ret'])[1])}}"><br>
    <label for="uptime">Uptime</label>
    <input disabled type="text" id="uptime" name="uptime" style="" value="{{ str_replace('uptime=','',explode(';',$mrResponse['after']['ret'])[10])}}"><br>
    <label for="radius">Radius</label>
    <input disabled type="text" id="radius" name="radius" style="" value="{{ str_replace('radius=','',explode(';',$mrResponse['after']['ret'])[7])}}"><br>
  @else
    <label for="pppinform">PPP</label>
    <input type="text" style="color:red; font-weight:bold;" name="pppinform" id="pppinform" value="Not Connected!" disabled><br>
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
        <button type="submit" class="btn btn-success"><i class="far fa-check-circle"></i> Submit</button>
    </form> 
    @endif     
  @endforeach
  
</div>
@endsection
