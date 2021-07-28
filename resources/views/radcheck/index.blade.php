@extends('layouts.app')
@section('title', 'Semua Post')
@section('content')
<div class="wrapper">
  <h1></h1>
  <button class="btn-blue"><a href="{{ url('/radcheck/create') }}">Add New</a></button>
  {{-- <form method="POST" action="#">
    @csrf
    <input name="username" type="text" placeholder="Username...">
    <button class="btn-blue">Submit</button>
  </form> --}}
  <table style="">
    <thead>
      <tr>
        <th>username</th>
        <th>password</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($raddatas as $raddata)
      @if ($raddata->attribute == 'Cleartext-Password')
      <tr>
        <td style="width: 150px" >{{ $raddata->username}}</td>
        <td style="width: 150px" >{{ $raddata->value }}</td>
        @if ($raddata->status == 'active')
            <td style="color: green">Active</td>
        @else
            <td style="color: grey">Unknown</td>
        @endif
        <td style="width: 100px"><button class="btn-green"><a href="{{ route('radcheck.edit', $raddata->id) }}">Edit</a></button></td>
        {{-- <form method="raddata" action="{{ url('radcheck', $raddata->id ) }}">
            @csrf
            @method('DELETE')
            <td style="width: 90px"><button class="btn-red">Hapus</button></td>
          </form>
      </tr>  --}}
      @endif
      
      @endforeach
    </tbody>
  </table>
</div>
@endsection
