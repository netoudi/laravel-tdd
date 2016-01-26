@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Tags</h3>

        <a href="{{ route('admin.tags.create') }}" class="btn btn-default btn-sm pull-right">New Tag</a>

        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th>Name</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('admin.tags.edit', ['id' => $tag->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.tags.destroy', ['id' => $tag->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection