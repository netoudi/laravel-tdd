@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Roles</h3>

        <a href="{{ route('admin.roles.create') }}" class="btn btn-default btn-sm pull-right">New Role</a>

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
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', ['id' => $role->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.roles.destroy', ['id' => $role->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection