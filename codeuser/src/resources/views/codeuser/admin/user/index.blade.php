@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>Users</h3>

        <a href="{{ route('admin.users.create') }}" class="btn btn-default btn-sm pull-right">New User</a>

        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th>Name</th>
                <th>E-mail</th>
                <th width="10%">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                        <a href="{{ route('admin.users.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection