<create-comment inline-template :post-data="{{$post}}">
    <div class="add-comment form-group">
        @include('errors.error')
        <form action="#" method="post" @submit.prevent="returnData">
            @csrf
            <textarea ref="textArea" v-model="text" name="text" rows="4" class="form-control" placeholder="Add comment"></textarea>
            <input ref="postId" type="hidden" name="post_id" value="{{$post->id}}">
            <input ref="userId" type="hidden" name="user_id" value="{{$post->user->id}}">
            <input ref="userName" type="hidden" name="user_name" value="{{Auth::user()->name}}">
            <input type="submit" class="button-primary-light" value="Post it">
        </form>
    </div>
</create-comment>