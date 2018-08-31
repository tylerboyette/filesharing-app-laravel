<form action="/comments" class="comment-form" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <textarea class="form-control comment-content" rows="3" name="content" placeholder="Add a reply..."></textarea>
        <input type="hidden" name="file_id" class="comment-file_id" value="{{ $file->id }}">
        <input type="hidden" name="parent_id" class="comment-parent_id" value="{{ $comment->id }}">
        <div class="invalid-feedback comment-content-error"></div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add a reply</button>
    </div>
</form>