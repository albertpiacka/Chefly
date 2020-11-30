<div class="wrapper">
    <div class="user-profile">
        <div class="profile-wrapper">
            <div class="top-box" data-aos="fade-down"></div>

            <div class="user-general-box" data-aos="fade-up">
                <div class="user-header">
                    <div class="user-avatar">
                    </div>
                    <div class="user-info">
                        <div class="user-controls">
                            <div class="user-name">
                                <h4>{{$user->name}}</h4>
                                <small>
                                    @if ($user->type == 0)
                                        Reader
                                    @elseif ($user->type == 1)
                                        Administrator
                                    @elseif ($user->type == 2)
                                        Associate editor
                                    @endif
                                </small>
                            </div>
                            @auth
                                <div class="user-buttons">
                                    @if ($user->id == Auth::user()->id)
                                        <a href="/profile"> <button>My profile</button></a>
                                    @else
                                        <open-chat :user-data="{{$user}}" :user-conversations="{{$user->conversations}}"></open-chat>
                                        <follow-user :user-data="{{$user}}" :follower-data="{{Auth::user()}}" :followers="{{$user->followers}}" inline-template>
                                            <button @click="toggleFollow" class="follow-button">@{{followText}}</button>
                                        </follow-user>   
                                    @endif
                                </div>
                            @endauth
                        </div>
                        <div class="info-tags">
                            <div class="info-box">
                                <small>Articles</small>
                                <div class="info-num">{{$user->posts->count()}}</div>
                            </div>
                            <div class="info-box">
                                <small>Followers</small>
                                <div class="info-num">{{$user->followers->count()}}</div>
                            </div>
                            <div class="info-box">
                                <small>Likes</small>
                                <div class="info-num">
                                   {{$user->postLikes->count()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

