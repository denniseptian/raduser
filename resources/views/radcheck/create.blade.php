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
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                    aria-label="Success:">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                    aria-label="Danger:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    @foreach ($errors->all() as $error)
                       {{ $error }}
                    @endforeach
                </div>
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
