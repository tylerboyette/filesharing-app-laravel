<ul class="list-group">
    @foreach($comment->replies as $reply)
        @include("files.partials.reply.list-item")
    @endforeach
</ul>