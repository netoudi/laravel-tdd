@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Categories</h3>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-default btn-sm pull-right">New Category</a>

        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->active ? 'Active' : 'Disabled' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection