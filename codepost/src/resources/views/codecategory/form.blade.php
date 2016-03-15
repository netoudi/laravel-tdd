@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>{{ empty($post) ? 'Create Post' : 'Update Post' }}</h3>

        @if(!empty($post))
            {!! Form::model($post, ['route' => ['admin.posts.update', $post->id]]) !!}
        @else
            {!! Form::open(['route' => 'admin.posts.store']) !!}
        @endif

        <div class="form-group">
            {!! Form::label('name', 'Title:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection