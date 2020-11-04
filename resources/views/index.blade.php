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
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrows-fullscreen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                    </svg>
                    <h2 class="headings-primary-light text-left"><a href="/posts/{{$posts[0]->slug}}">{{$posts[0]->title}}</a></h2>
                    <p style="padding: 1em; text-indent: 4em" class="text-justify">{{$posts[0]->text}}</p>
                    <h4><a href="/users/{{$posts[0]->user->id}}">{{$posts[0]->user->name}}</a></h4>
                </div>

                <div class="post">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrows-fullscreen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                    </svg>
                    <h2 class="headings-primary-light text-left"><a href="/posts/{{$posts[1]->slug}}">{{$posts[1]->title}}</a></h2>
                    <p style="padding: 1em; text-indent: 4em" class="text-justify">{{$posts[1]->text}}</p>
                    <h4><a href="/users/{{$posts[1]->user->id}}">{{$posts[1]->user->name}}</a></h4>
                </div>
            </div>

            <div class="about-wrapper">

                <blockquote data-aos="zoom-in-up">
                    <h2 class="headings-primary-dark">What is this about anyway?</h2>
                    <footer class="text-primary-dark">Chefly is a small project focused in the world of culinary and gastronomy. Main goal is to gather useful information and spread them to the world.  </footer>
                 </blockquote>

                 <h2 data-aos="zoom-in-up" class="headings-primary-dark">Chefly lets you..</h3>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Create and customize your articles</h3>
                    <footer class="text-primary-dark">Chefly has intuitive system of creating articles. It's simple, yet effective!</footer>
                 </blockquote>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Discuss topics with anyone</h3>
                    <footer class="text-primary-dark">You can see what people say about your newest post. Wheter they liked it or not.</footer>
                 </blockquote>

                 <blockquote data-aos="zoom-in-up">
                    <h3 class="headings-primary-dark">Share your thoughts through your profile</h3>
                    <footer class="text-primary-dark">Tell people about yourself!</footer>
                 </blockquote>

            </div>
        </div>
    </div>
@endsection

