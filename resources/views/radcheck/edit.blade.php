@extends('layouts.app')
@section('title', 'Rad Edit')
@section('menu')
    <a class="nav-link active" style="font-weight: bold" aria-current="page" href="{{ URL::previous() }}"><i
            class="fas fa-arrow-circle-left"></i> BACK</a>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/radcheck') }}">Home</a>
        </li>
        <li>
            <a class="nav-link">UID <b>{{ $raddata[0]['username'] }}</b></a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="wrapper">
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
        @if ($mrResponse != false)
            {{-- {{ print_r(explode(';',$mrResponse['after']['ret'])) }} --}}
            <div class="row">
                <div class="col-sm-4">
                    <form method="POST" action="{{ url('radcheck/ifaceremove', $raddata[0]->username) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="pppinform">PPP Status:</label>
                                    <input type="text" class="form-control" style="color:green; font-weight:bold;"
                                        name="pppinform" id="pppinform" value="Connected!" aria-describedby="pppinform"
                                        disabled>
                                    <small id="pppinform" class="form-text text-muted">Informasi tentang koneksi
                                        ppp.</small>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="reloadPPP"></label>
                                <button class="btn btn-success form-control" type="submit" name="reloadPPP"
                                    id="reloadPPP"><i class="fas fa-power-off"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input disabled type="text" class="form-control" id="address" name="address" style=""
                            value="{{ str_replace('address=', '', explode(';', $mrResponse['after']['ret'])[1]) }}"
                            aria-describedby="address">
                        <small id="address" class="form-text text-muted">IP Address client.</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="uptime">Uptime</label>
                        <input disabled type="text" class="form-control" id="uptime" name="uptime" style=""
                            value="{{ str_replace('uptime=', '', explode(';', $mrResponse['after']['ret'])[10]) }}"
                            aria-describedby="uptime">
                        <small id="uptime" class="form-text text-muted">Total ppp terkoneksi dengan router.</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="radius">Radius</label>
                        <input disabled type="text" class="form-control" id="radius" name="radius" style=""
                            value="{{ str_replace('radius=', '', explode(';', $mrResponse['after']['ret'])[7]) }}"
                            aria-describedby="radius">
                        <small id="radius" class="form-text text-muted">Koneksi radius.</small>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="pppinform">PPP Status:</label>
                        <input type="text" class="form-control" style="color:red; font-weight:bold;" name="pppinform"
                            id="pppinform" value="Not Connected!" aria-describedby="pppinform" disabled>
                        <small id="pppinform" class="form-text text-muted">Informasi tentang koneksi ppp.</small>
                    </div>
                </div>
            </div>
        @endif
        @foreach ($raddata as $rad)
            @if ($rad->attribute == 'Cleartext-Password')
                {{-- <form method="POST" action="{{ url('radcheck', $rad->id ) }}"> --}}
                {{-- @csrf --}}
                {{-- @method('PUT') --}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control" id="username" name="username"
                                            value="{{ $rad->username }}" type="text" placeholder="Title..."
                                            aria-describedby="username" disabled>
                                        <small id="username" class="form-text text-muted">Username PPP radius.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input class="form-control" type="text" name="password" id="password"
                                        value="{{ $rad->value }}" placeholder="Password" aria-describedby="password"
                                        disabled>
                                    <small id="password" class="form-text text-muted">Password PPP radius.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <button class="btn-blue">Submit</button> --}}
                {{-- </form> --}}
            @elseif ($rad->attribute == "User-Profile")
                <form method="POST" action="{{ url('radcheck', $rad->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="value" tabindex="2">Profile</label>
                                    <select class="form-select" aria-label="Default select example" name="value" id="value">
                                        @if ($rad->value == 'expired')
                                            <option value="expired" selected>expired</option>
                                            <option value="active">active</option>
                                        @elseif ($rad->value == "active")
                                            <option value="expired">expired</option>
                                            <option value="active" selected>active</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="#" tabindex="2"></label>
                                        <button type="submit" class="btn btn-success form-control"><i
                                                class="far fa-check-circle"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endforeach
    </div>
@endsection
