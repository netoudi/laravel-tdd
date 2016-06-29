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

        <h3>State Post: <?= ($post->state == $post::STATE_PUBLISHED) ? 'Published' : 'Draft'; ?></h3>
        <hr>
        @if(!empty($post))
            @if ($post->state == $post::STATE_PUBLISHED)
                {!! Form::open(['route' => ['admin.posts.update-state', $post->id], 'method' => 'patch']) !!}
                {!! Form::hidden('state', $post::STATE_DRAFT) !!}
                <div class="form-group text-right">
                    {!! Form::submit('Draft', ['class'=>'btn btn-warning btn-sm']) !!}
                </div>
                {!! Form::close() !!}
            @else
                {!! Form::open(['route' => ['admin.posts.update-state', $post->id], 'method' => 'patch']) !!}
                {!! Form::hidden('state', $post::STATE_PUBLISHED) !!}
                <div class="form-group text-right">
                    {!! Form::submit('Publish', ['class'=>'btn btn-success btn-sm']) !!}
                </div>
                {!! Form::close() !!}
            @endif
        @endif

    </div>

@endsection
