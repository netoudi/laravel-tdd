@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Permission Details</h3>

        <ul class="list-unstyled">
            <li>
                <strong>Name:</strong> {{ $permission->name }}
            </li>
            <li>
                <strong>Description:</strong> {{ $permission->description }}
            </li>
        </ul>

        <hr>

        <div class="form-group text-right">
            <a class="btn btn-warning btn-sm" href="{{ route('admin.permissions.index') }}" role="button">Back</a>
        </div>

    </div>

@endsection