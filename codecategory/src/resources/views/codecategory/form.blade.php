@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ empty($category) ? 'Create Category' : 'Update Category' }}</h3>

        @if(!empty($category))
            {!! Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}
        @else
            {!! Form::open(['route' => 'admin.categories.store']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('parent', 'Parent:') !!}
            {!! Form::select('parent_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('active', 'Active:') !!}
            {{ Form::checkbox('active', null, null) }}
        </div>

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.categories.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection