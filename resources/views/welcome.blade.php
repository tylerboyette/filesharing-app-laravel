@extends ("layouts.master")

@section ("content")
    <div class="dropbox-overlay">
        <div class="vertical-center justify-content-center">
            <div class="dropbox-overlay__info d-flex flex-column">
                <span class="dropbox-overlay__text">Please drop the file here.</span>
                <span class="dropbox-overlay__hint">The maximum file size is 100 MB.</span>
            </div>
        </div>
    </div>
    <div class="vertical-center">
        <div class="container">
            <form action="/upload" id="file-upload-form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input id="file-input" name="file" type="file">
                    <div class="file-upload-errors"></div>
                </div>
            </form>
            <div class="filesize-hint">Max file size is 100 MB</div>
        </div>
    </div>
@endsection