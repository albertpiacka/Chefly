{{-- <update-comment :comment-data="{{ $comment }}" inline-template>
    <transition name="fade">
        <div class="comment" datetime="{{$comment->created_at->toW3cString()}}" v-show="visible">
            <strong class="headings-primary-light">{{$comment->user->name}}</strong>
            <span class="time">{{$comment->created_at->diffForHumans()}}</span>
            <p 
                :contenteditable="editable"
                ref="input"
                @input="textChanged"
                @blur="stopEditing"
                @keydown.esc="stopEditing"
                @keydown.enter="updateComment"
            >
                {{$comment->text}}
            </p>
            @can('update', $comment)
                <div class="comment-controls">
                    <small @click="startEditing">edit</small>
                    <svg @click="deleteComment" width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
            @endcan
        </div>
    </transition>
</update-comment> --}}