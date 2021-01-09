<div class="wrapper">
    <div class="user-profile">
        <div class="profile-wrapper">
            <div class="top-box" data-aos="fade-down"></div>

            <div class="user-general-box" data-aos="fade-up">
                <div class="user-info">
                    <div class="edit-wrapper">
                        <div class="user-avatar">
                            @if ($user->image)
                                <img src="<?php echo url('/')?>/{{$user->image}}" class="img-fluid" alt="#">
                            @else
                                <img src="<?php echo url('/')?>/user-default.png" class="img-fluid" alt="#">
                            @endif
                        </div>
    
                        <div class="user-controls-wrapper">
                            <div class="user-name">
                                <h4>{{$user->name}}</h4>
                                <small>
                                    @if ($user->type == 1)
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

                            <div class="about">
                                <small class="about-heading">About me</small>
                                <p class="about-text">{{$user->about}}</p>
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
</div>

