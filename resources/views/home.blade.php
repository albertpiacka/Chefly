@extends('layouts.app', ['class' => 'Home'])

@section('content')

<div class="welcome-wrapper" data-aos="fade-up">
    <div class="date">
        {{$date}}
    </div>
    
    <div class="hello-user">
        Hello, {{Auth::user()->name}}
    </div>

    <div class="quickPostForm">
        <quick-post-form :user="{{Auth::user()}}"></quick-post-form>   
    </div>

    <following-posts 
    :user="{{Auth::user()}}" 
    :following="{{$following}}"
    :my-posts="{{Auth::user()->posts}}"
    :my-Quickposts="{{Auth::user()->quickposts}}"
    base-url="<?php echo url('/')?>"
    ></following-posts>
</div>

@endsection

