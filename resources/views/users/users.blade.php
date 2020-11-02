@extends('layouts.app', ['class' => 'Users'])

@section('content')
<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content">

            <div class="posts" data-aos="fade-up">
                @foreach ($users as $user)
                    <h1>{{$user->name}}</h1>
                @endforeach
            </div>

        </div>
    </div>
@endsection

