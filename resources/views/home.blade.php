@extends('layouts.app', ['class' => 'Home'])

@section('content')

<div class="welcome-wrapper" data-aos="fade-up">
    <div class="date">
        {{$date}}
    </div>
    
    <div class="hello-user">
        Hello, {{Auth::user()->name}}
    </div>

    {{-- <div class="quickpost" data-aos="fade-up" data-aos-delay="300">
        <quick-post :user="{{Auth::user()}}"></quick-post>
    </div> --}}

    <following-posts 
    :user="{{Auth::user()}}" 
    :following="{{Auth::user()->following}}"
    base-url="<?php echo url('/')?>"
    ></following-posts>
</div>

@endsection

