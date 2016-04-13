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
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {{-- Form::textarea('content', null, ['class' => 'form-control']) --}}
            <textarea name="content" id="mytiny">{{ !empty($post) ? $post->content : '' }}</textarea>
            @include('tinymce::tpl')
        </div>

        <hr>

        <div class="form-group text-right">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
            <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.index') }}" role="button">Cancel</a>
        </div>

        {!! Form::close() !!}
    </div>

@endsection