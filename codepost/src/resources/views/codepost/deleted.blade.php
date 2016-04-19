@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Posts Deleted</h3>

        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th>Title</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection