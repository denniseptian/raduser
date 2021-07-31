@extends('layouts.app')
@section('title', 'Semua Post')
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-md-8">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="nav-link active" aria-current="page" href="{{ url('/radcheck/create') }}"><i
                                class="fas fa-user-plus"></i> Add new</a>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li>
                                    <a class="nav-link">Home | Daftar radius account.</b></a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                            <a class="nav-link" href="#"><i class="fas fa-arrow-circle-left"></i> logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <label for=""></label><br>
        <div class="row">
            <div class="col-md-6">
                <table id="example" class="display" style="width:100%">
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
                                    <td style="width: 150px">{{ $raddata->username }}</td>
                                    <td style="width: 150px">{{ $raddata->value }}</td>
                                    @if ($raddata->status == 'active')
                                        <td style="color: green">Active</td>
                                    @else
                                        <td style="color: grey">Unknown</td>
                                    @endif
                                    <td><a class="btn btn-warning" href="{{ route('radcheck.edit', $raddata->id) }}"
                                            role="button">Edit</a></td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
