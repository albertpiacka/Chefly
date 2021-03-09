<div class="post shadow-lg" data-aos="fade-up" data-aos-delay="{{$post->id}}00">
    @if ($post->image)
        <div class="post-header">
            <img src="<?php echo url('/storage/posts-images')?>/{{$post->image}}" class="img-fluid" alt="#">
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
        </div>

        <div class="author-info">
            <h3><small>Author | </small><a href="/users/{{$post->user->id}}">{{$post->user->name}}</a></h3>
            <span class="time"><small>Posted | </small>{{$post->created_at->format('d/m/Y')}}</span>
        </div>
    </div>
</div>    

    

