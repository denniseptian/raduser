@extends('layouts.app')
@section('title', 'Semua Post')
@section('cssaddons')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
@endsection
@section('menu')
<a class="nav-link active" aria-current="page" href="{{ url('/radcheck/create') }}"><i class="fas fa-user-plus"></i>
    Add new</a>
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li>
        <a class="nav-link">Home</b></a>
    </li>
</ul>
@endsection
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-6">
            <table id="raddataTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Status</th>
                        <th></th>
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
                                <td><a class="btn btn-info btn-sm" href="{{ route('radcheck.edit', $raddata->id) }}"
                                        role="button"><i class="fas fa-pen"></i> Edit</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('jsaddons')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#raddataTable').DataTable({
            "ordering": false
        });
    });
</script>
@endsection
