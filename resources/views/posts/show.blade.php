@extends('layouts.app', ['class' => 'Post'])

@section('content')

<div class="container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="posts" data-aos="fade-up">

                <div class="animation-container">
                    @include('posts.post')
                </div>
                <div class="comment-section">
                    @auth
                        @include('comments.create')
                    @endauth
                    <button class="navbar-toggler bg-transparent text-white" type="button" data-toggle="collapse" data-target="#commentsCollapse{{$post->id}}" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                    <div class="collapse navbar-collapse" id="commentsCollapse{{$post->id}}">
                        <ul class="navbar-nav mr-auto">
                            <comments-all :post-data="{{$post}}" inline-template>
                            
                                <div class="comments">
                                    <transition-group name="fade">
                                        <div class="comment" v-for="comment in comments" :key="comment.id">
                                            <strong class="headings-primary-light">@{{comment.user.name}}</strong>
                                            <span class="time">@{{prettyDate(comment.created_at)}}</span>
                                            <p>
                                                @{{comment.text}}
                                            </p>
                                        </div>
                                    </transition-group>
                                </div>
                            
                            </comment-section>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

