@extends('layouts.app')
@section('title', 'Semua Post')
@section('content')
<div class="wrapper">
  <h1 style="text-align: center;">Semua Post</h1>
  <table style="width:100%">
    <thead>
      <tr>
        <th>Title</th>
        <th>Body</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td style="width: 200px" >{{ $post->title}}</td>
        <td style="width: 500px" >{{ $post->body }}</td>
        <td style="width: 100px"><button class="btn-green"><a href="{{ route('posts.edit', $post->id) }}">Edit</a></button></td>
        <form method="POST" action="{{ url('posts', $post->id ) }}">
            @csrf
            @method('DELETE')
            <td style="width: 100px"><button class="btn-red">Hapus</button></td>
          </form>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
