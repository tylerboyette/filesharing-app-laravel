@extends ("layouts.master")

@section ("content")
    <div class="vertical-center justify-content-center">
        <div class="d-flex">
            <form action="/upload" id="file-upload-form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
            <span class="btn btn-success fileinput-button">
                <span>Select a file</span>
                <input type="file" name="file" id="fileupload">
            </span>
                </div>
            </form>
        </div>
    </div>
@endsection