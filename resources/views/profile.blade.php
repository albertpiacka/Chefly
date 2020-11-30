@extends('layouts.app', ['class' => 'Profile'])

@section('content')
<div class="wrapper">
    <div class="user-profile">
        <div class="profile-wrapper">
            <div class="top-box" data-aos="fade-down"></div>

            <div class="user-general-box" data-aos="fade-up">
                <div class="user-header">
                    <div class="user-avatar">
                    </div>
                    <div class="user-info">
                        <edit-user inline-template :user-data="{{Auth::user()}}">
                            <div class="edit-wrapper">
                                <div class="user-controls">
                                    <div class="user-name">
                                        <h4
                                         :contenteditable="editing"
                                         @input="returnValue"
                                         @blur="saveValue"
                                         ref="userName"
                                        >
                                           @{{name}}
                                        </h4>
                                        <small>
                                            @if (Auth::user()->type == 0)
                                                Reader
                                            @elseif (Auth::user()->type == 1)
                                                Administrator
                                            @elseif (Auth::user()->type == 2)
                                                Associate editor
                                            @endif
                                        </small>
                                    </div>
                                    <div class="user-buttons">
                                        <button class="edit-button">
                                            <a @click.prevent="startEditing">@{{text}}</a>
                                        </button>
                                    </div>
                                </div>
                                <div class="about">
                                    <small>About :</small>
                                </div>
                            </div>
                        </edit-user>
                        <div class="info-tags">
                            <div class="info-box">
                                <small>Articles</small>
                                <div class="info-num">{{Auth::user()->posts->count() ?? '-'}}</div>
                            </div>
                            <div class="info-box">
                                <small>Followers</small>
                                <div class="info-num">{{Auth::user()->followers->count()}}</div>
                            </div>
                            <div class="info-box">
                                <small>Likes</small>
                                <div class="info-num">
                                   {{Auth::user()->postLikes->count()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-work-box" 
            data-aos="fade-up" 
            data-aos-delay="300"
        >
            <div class="articles-boxed">

                
            </div>
        </div>
    </div>
</div>
@endsection
