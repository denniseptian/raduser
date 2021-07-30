@extends('layouts.app')
@section('title', 'Semua Post')
@section('content')
<div class="wrapper">
  <nav class="nav">
    <a class="nav-link active" aria-current="page" href="{{ url('/radcheck/create') }}">Add new</a>
    <a class="nav-link" href="#">soons</a>
  </nav>
  <table class="table table-borderless">
    <thead>
      <tr>
        <th scope="col">Username</th>
        <th scope="col">Password</th>
        <th scope="col">Status</th>
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
        <td ><a class="btn btn-warning" href="{{ route('radcheck.edit', $raddata->id) }}" role="button">Edit</a></td>
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
  {{-- <form method="POST" action="#">
    @csrf
    <input name="username" type="text" placeholder="Username...">
    <button class="btn-blue">Submit</button>
  </form> --}}
  
</div>
@endsection
