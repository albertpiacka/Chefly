@extends('layouts.app', ['class' => 'Chefly'])

@section('content')
<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content">
            
            <div class="title-secondary title text-center pb-5">
                <h2 class="headings-primary-dark display-2">Don't miss out!</h2>
            </div>
            
            <div class="posts" data-aos="fade-up">
                <div class="post">
                    <div class="post-wrapper">
                        <div class="post-body">
                            <h2><a href="/posts/{{$posts[0]->slug}}">{{$posts[0]->title}}</a></h2>
                            <div class="content">
                                {!! nl2br($posts[0]->text) !!}
                            </div>
                        </div>
                        <div class="author-info">
                            <h3><a href="/users/{{$posts[0]->user->id}}">{{$posts[0]->user->name}}</a></h3>
                        </div>
                    </div>
                </div>

                <div class="post">
                    <div class="post-wrapper">
                        <div class="post-body">
                            <h2><a href="/posts/{{$posts[1]->slug}}">{{$posts[1]->title}}</a></h2>
                            <div class="content">
                                {!! nl2br($posts[1]->text) !!}
                            </div>
                        </div>
                        <div class="author-info">
                            <h3><a href="/users/{{$posts[1]->user->id}}">{{$posts[1]->user->name}}</a></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-wrapper">

                <blockquote data-aos="zoom-in-up">
                    <h2 class="headings-primary-dark">What is this about anyway?</h2>
                    <footer class="text-primary-dark">Chefly is a small project focusing on the world of culinary and gastronomy. Main goal is to gather useful information and share them among people.</footer>
                 </blockquote>

                 <h2 data-aos="zoom-in-up" class="headings-primary-dark">Chefly lets you..</h3>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Create and customize your articles</h3>
                    <footer class="text-primary-dark">Chefly has intuitive system of creating articles. It's simple, yet effective!</footer>
                 </blockquote>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Discuss hot topics with anyone</h3>
                    <footer class="text-primary-dark">You can see what people have to say about your insight.</footer>
                 </blockquote>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Share your thoughts through your profile</h3>
                    <footer class="text-primary-dark">Tell people about yourself!</footer>
                 </blockquote>

            </div>
        </div>
    </div>
@endsection

