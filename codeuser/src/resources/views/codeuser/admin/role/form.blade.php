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

        @if(!empty($role))
            <div class="form-group">
                {!! Form::label('permissions[]', 'Permissions:') !!}
                {!! Form::select('permissions[]', $permissions, $role->permissions->lists('id')->toArray(), ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        @else
            <div class="form-group">
                {!! Form::label('permissions[]', 'Permissions:') !!}
                {!! Form::select('permissions[]', $permissions, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        @endif

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.roles.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection