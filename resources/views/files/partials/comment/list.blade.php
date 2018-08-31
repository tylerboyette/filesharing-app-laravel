<ul class="list-group">
    @foreach($comments as $comment)
        @include("files.partials.comment.list-item")
    @endforeach
</ul>