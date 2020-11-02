@extends('layouts.app', ['class' => 'Posts'])

@section('content')
<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content">

            <div class="posts" data-aos="fade-up">
                @foreach ($posts as $post)
                    <div class="post">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrows-fullscreen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                        </svg>
                        <h2 class="headings-primary-light text-left"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                        <p class="text-left">{{$post->text}}</p>
                        <h3>{{$post->user->name}}</h3><br>
                        @foreach ($post->comments as $comment)
                            <strong>{{$comment->user->name}}</strong>
                            <p>{{$comment->text}}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

