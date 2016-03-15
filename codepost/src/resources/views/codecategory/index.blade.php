@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Posts</h3>

        <a href="{{ route('admin.posts.create') }}" class="btn btn-default btn-sm pull-right">New Post</a>

        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', ['id' => $post->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.posts.destroy', ['id' => $post->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection