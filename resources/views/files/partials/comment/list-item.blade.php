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
                <div class="comment-content mb-2">
                    {{ $comment->content }}
                </div>
                <span class="reply-link">Reply</span>
                <div class="reply-form">
                    <form action="/comments" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" rows="3" id="comment-content" name="content" placeholder="Add a reply..."></textarea>
                            <input type="hidden" name="file_id" id="comment-file_id" value="{{ $file->id }}">
                            <div class="invalid-feedback comment-content-error"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add a comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</li>