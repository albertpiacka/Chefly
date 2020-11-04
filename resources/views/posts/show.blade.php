@extends('layouts.app', ['class' => 'Post'])

@section('content')

<div class="animation-container container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="posts" data-aos="fade-up">

                @include('posts.post')

            </div>
        </div>
    </div>
</div>

@endsection

