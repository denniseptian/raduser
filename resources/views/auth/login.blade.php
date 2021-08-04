@extends('layouts.auth')
@section('title', 'Login sluer!')
@section('content')
    <div class="row">
        <div class="col-sm-3">
            <form method="POST" action="{{ route('login.custom') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                    <small id="email" class="form-text text-muted">Masukkan username untuk melakukan login.</small>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                        required>
                    <small id="password" class="form-text text-muted">Masukkan password untuk melakukan login.</small>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
@endsection
