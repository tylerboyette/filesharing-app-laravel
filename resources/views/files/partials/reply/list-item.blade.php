<li class="list-group-item">
    <div class="media">
        <div class="media-left mr-3">
            @if ($comment->user)
                <img class="uploader-avatar" src="{{ asset("storage/avatars/{$comment->user->avatar_name}") }}" alt="Avatar">
            @else
                <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="Avatar">
            @endif
        </div>
        <div class="media-body">
            <div class="comment-info">
                <span class="comment-info__author-name"><b>{{ $comment->user ? $comment->user->username : "Anonymous" }}</b></span>
                <span class="comment-info__date">{{ $comment->created_at->format("M j, Y H:i") }}</span>
                <div class="comment-content mb-2">{{ $comment->content }}</div>
                <div class="reply-form">
                    <form action="/comments" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control reply-content" rows="3" name="content" placeholder="Add a reply..."></textarea>
                            <input type="hidden" name="file_id" class="comment-file_id" value="{{ $file->id }}">
                            <input type="hidden" name="parent_id" class="comment-parent_id" value="{{ $comment->id }}">
                            <div class="invalid-feedback reply-content-error"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add a reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</li>