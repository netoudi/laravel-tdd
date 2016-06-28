@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ empty($user) ? 'Create User' : 'Update User' }}</h3>

        @if(!empty($user))
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id]]) !!}
        @else
            {!! Form::open(['route' => 'admin.users.store']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'E-mail:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        @if(!empty($user))
            <div class="form-group">
                {!! Form::label('roles[]', 'Roles:') !!}
                {!! Form::select('roles[]', $roles, $user->roles->lists('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        @else
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('roles[]', 'Roles:') !!}
                {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        @endif

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.users.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection