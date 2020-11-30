<div class="post">
    <div class="post-wrrapper">
        <div class="post-body">
            <h2><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
            <div class="content">
                {!! nl2br($post->text) !!}
            </div>
        </div>

        <div class="author-info">
            <h3><small>Author | </small><a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></h3>
            <span class="time"><small>Posted | </small>{{$post->created_at->format('d/m/Y')}}</span>
        </div>

        @auth
            <like-post inline-template :post-data="{{$post}}" :user-data="{{Auth::user()}}">
                <svg @click="toggleLike" width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
            </like-post>
        @endauth
    </div>
</div>    

    

