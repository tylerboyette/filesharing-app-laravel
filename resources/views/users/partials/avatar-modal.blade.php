<div class="modal" id="avatarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/avatars" method="post">
                    <div class="form-group">
                        <input class="form-control" type="file" id="avatar-upload" name="avatar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>