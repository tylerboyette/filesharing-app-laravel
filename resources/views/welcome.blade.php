@extends ("layouts.master")

@section ("content")
    <div class="dropbox d-flex justify-content-center align-items-center">
        <div class="dropbox__info d-flex flex-column">
            <span class="dropbox__text">Please drag and drop a file here.</span>
            <span class="dropbox__hint">The maximum file size is 100 MB.</span>
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
        </div>
    </div>
@endsection