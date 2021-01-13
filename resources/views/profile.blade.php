@extends('layouts.app', ['class' => 'Profile'])

@section('content')
<div class="wrapper">
    <div class="user-profile">
        <div class="profile-wrapper">
            <div class="top-box" data-aos="fade-down"></div>

            <div class="user-general-box" data-aos="fade-up">
                <div class="user-info">
                    <edit-user inline-template :user-data="{{Auth::user()}}">
                        <div class="edit-wrapper">
                            <div class="user-avatar">
                                @if (Auth::user()->image)
                                    <img 
                                        src="<?php echo url('/')?>/{{Auth::user()->image}}"
                                        class="img-fluid" 
                                        ref="userImg"
                                        alt="#"
                                    >
                                    <input 
                                        @change="setImg"
                                        type="file" 
                                        name="user-img-file" 
                                        id="user-img-file" 
                                        ref="userImgFile"
                                        v-show="editing"
                                    >
                                @else
                                    <img 
                                        src="<?php echo url('/')?>/user-default.png"
                                        class="img-fluid" 
                                        ref="userImg"
                                        alt="#"
                                    >
                                    <input 
                                        @change="setImg"
                                        type="file" 
                                        name="user-img-file" 
                                        id="user-img-file" 
                                        ref="userImgFile"
                                        v-show="editing"
                                    >
                                @endif
                            </div>

                            <div class="user-controls-wrapper">

                                <div class="user-name">
                                    <div>
                                        <h4
                                        :contenteditable="editing"
                                        :class="{editing: editing}"
                                        @input="returnName"
                                        ref="userName"
                                        >
                                        @{{name}}
                                        </h4>
                                        <small>
                                            @if (Auth::user()->type == 1)
                                                Administrator
                                            @elseif (Auth::user()->type == 2)
                                                Associate editor
                                            @endif
                                        </small>
                                    </div>

                                    <div class="user-buttons">
                                        <button class="edit-button">
                                            <a @click.prevent="toggleEditing">@{{text}}</a>
                                        </button>
                                    </div>
                                </div>

                                <div class="about">
                                    <small class="about-heading">About me</small>
                                    <p class="about-text"
                                    :contenteditable="editing"
                                    :class="{editing: editing}"
                                    @input="returnAbout"
                                    ref="aboutMe"
                                    >@{{about}}</p>
                                </div>

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
                    </edit-user>
                </div>
            </div>

            <div class="quickpost" data-aos="fade-up" data-aos-delay="300">
                <quick-post :user="{{Auth::user()}}"></quick-post>
            </div>
        </div>
    </div>
</div>
@endsection

