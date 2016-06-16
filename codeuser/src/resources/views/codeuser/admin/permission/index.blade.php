@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Permissions</h3>

        <a href="{{ route('admin.permissions.create') }}" class="btn btn-default btn-sm pull-right">New User</a>

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
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.view', ['id' => $permission->id]) }}" class="btn btn-danger btn-xs">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection