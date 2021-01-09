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
                    <comments-all :post-data="{{$post}}" inline-template>
                        <div>
                            <button class="navbar-toggler bg-transparent text-white" type="button" data-toggle="collapse" data-target="#commentsCollapse{{$post->id}}" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
                            @click="toggleComments"    
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16"
                                :class="[{ closed: !toggled}, {opened: toggled}]"
                                >
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                  </svg>
                            </button>
                            <div class="collapse navbar-collapse comment-collapse" id="commentsCollapse{{$post->id}}" 
                            >
                                <ul class="navbar-nav mr-auto">
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
                                </ul>
                            </div>
                        </div>
                    </comment-section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

