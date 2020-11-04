@extends('layouts.app', ['class' => 'Posts'])

@section('content')

<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="posts" data-aos="fade-up">
                @foreach ($posts as $post)
                    @include('posts.post')
                @endforeach
            </div>
        </div>
    </div>

@endsection

