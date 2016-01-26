@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ empty($tag) ? 'Create Tag' : 'Update Tag' }}</h3>

        @if(!empty($tag))
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag->id]]) !!}
        @else
            {!! Form::open(['route' => 'admin.tags.store']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.tags.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection