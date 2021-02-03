@extends('layouts.app', ['class' => 'Posts'])

@section('content')

<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <all-tags :tags="{{$tags}}"></all-tags>

            <div class="posts">
                @foreach ($posts as $post)
                    @include('posts.postThumbnail')
                @endforeach
            </div>
        </div>
    </div>

@endsection

