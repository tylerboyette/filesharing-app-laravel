<li class="list-group-item">
    <div class="media">
        <div class="media-left mr-3">
            @if ($reply->user)
                <img class="uploader-avatar" src="{{ asset("storage/avatars/{$reply->user->avatar_name}") }}" alt="Avatar">
            @else
                <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="Avatar">
            @endif
        </div>
        <div class="media-body">
            <div class="comment-info">
                <span class="comment-info__author-name"><b>{{ $reply->user ? $reply->user->username : "Anonymous" }}</b></span>
                <span class="comment-info__date">{{ $reply->created_at->format("M j, Y H:i") }}</span>
                <div class="comment-content mb-2">{{ $reply->content }}</div>
            </div>
        </div>
    </div>
</li>