@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ empty($role) ? 'Create Role' : 'Update Role' }}</h3>

        @if(!empty($role))
            {!! Form::model($role, ['route' => ['admin.roles.update', $role->id]]) !!}
        @else
            {!! Form::open(['route' => 'admin.roles.store']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.roles.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection