<div class="post">
    @if ($post->image)
        <div class="post-header">
            <img src="<?php echo url('/posts-images/')?>/{{$post->image}}" class="img-fluid" alt="#">
        </div>
    @endif
    
    <div class="post-wrrapper">
        <div class="post-body">
            <div class="post-body-header">
                <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
                @auth
                    <bookmark-post inline-template :post-data="{{$post}}" :user-data="{{Auth::user()}}">
                        <svg @click="toggleBookmark" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm6.854 5.854a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                        </svg>
                    </bookmark-post>
                @endauth
            </div>
            <div class="content">
                {!! nl2br($post->text) !!}
            </div>
        </div>

        <div class="author-info">
            <h3><small>Author | </small><a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></h3>
            <span class="time"><small>Posted | </small>{{$post->created_at->format('d/m/Y')}}</span>
        </div>

        <div class="tags">
            @foreach ($post->tags as $tag)
                <b-button pill variant="primary">
                    {{$tag->tag}}
                </b-button>
            @endforeach
        </div>

        @auth
            <like-post inline-template :post-data="{{$post}}" :user-data="{{Auth::user()}}">
                <div class="likes-wrapper">
                    <svg @dblclick="toggleLike" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                    <div class="likes-count">
                        @{{postLikes}}
                    </div>
                </div>
            </like-post>
        @endauth
    </div>
</div>    

    

