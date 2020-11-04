<div class="post">
    <div class="post-body">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrows-fullscreen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
        </svg>
        <h2 class="headings-primary-light text-left"><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h2>
        <p class="text-left">{{$post->text}}</p>
    </div>
    <div class="author-info">
        <h3 class="headings-primary-light">{{$post->user->name}}</h3>
        <span class="time">{{$post->created_at->format('d/m/Y')}}</span>
    </div>
    <button class="navbar-toggler bg-transparent" type="button" data-toggle="collapse" data-target="#commentsCollapse{{$post->id}}" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
        </svg>
    </button>
    <div class="collapse navbar-collapse" id="commentsCollapse{{$post->id}}">
        <ul class="navbar-nav mr-auto">
            <div class="comments">
                @foreach ($post->comments as $comment)
                    <div class="comment" datetime="{{$comment->created_at->toW3cString()}}">
                        <strong class="headings-primary-light">{{$comment->user->name}}</strong>
                        <span class="time">{{$comment->created_at->diffForHumans()}}</span>
                        <p>{{$comment->text}}</p>
                    </div>
                @endforeach
            </div>
            @auth
                @include('comments.create')
            @endauth
        </ul>
    </div>
</div>

