@extends('layouts.app')
@section('title', 'Buat Username Baru')
@section('menu')
    <a class="nav-link active" style="font-weight: bold" aria-current="page" href="{{ URL::previous() }}"><i
            class="fas fa-arrow-circle-left"></i> BACK</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/radcheck') }}">Home</a>
        </li>
        <li>
            <a class="nav-link" style="font-weight: 120">Create a new user</b></a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="wrapper">
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
        <label for=""></label><br>
        <div class="row">
            <div class="col-sm-4">
                <form method="POST" action="{{ url('radcheck') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="username"
                            placeholder="11600XXXX">
                        <small id="username" class="form-text text-muted">Masukkan kode yang di dapat dari web
                            manage.</small>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
