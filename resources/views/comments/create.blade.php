<div class="add-comment form-group">
    @include('errors.error')
    <form action="/comments" method="post">
        @csrf
        <textarea name="text" rows="4" class="form-control" placeholder="Add comment"></textarea>
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="submit" class="button-primary-light">
    </form>
</div>