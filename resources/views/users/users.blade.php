@extends('layouts.app', ['class' => 'Users'])

@section('content')
<div class="container py-5">
    <div class="flex-center position-ref full-height">
        <div class="content" data-aos="fade-up">

            <search-bar inline-template>
                <form @input="returnData" class="search-form">
                    <input type="search" placeholder="Search" v-model="search">
                </form>
            </search-bar>

            <users-all inline-template :users-data="{{$users}}">
                <div class="users" >
                    <transition-group name="fade">
                        <div v-for="user in filteredItems" :key="user.id">
                            <div class="user">
                                <div class="user-info">
                                    <a :href="`/users/${user.id}`" >@{{ user.name }}</a>
                                    <div class="register-date">On Chefly since : @{{prettyDate(user.created_at)}}</div>
                                </div>
                                <div class="user-link">
                                    <a :href="`/users/${user.id}`">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </transition-group> 
                </div>
            </users-all>
        
        </div>
    </div>
@endsection

