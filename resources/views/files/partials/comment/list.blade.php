<ul class="list-group">
    @foreach($file->comments as $comment)
        @include("files.partials.comment.list-item")
    @endforeach
</ul>