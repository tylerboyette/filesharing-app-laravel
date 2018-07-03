@extends ("layouts.master")

@section ("content")
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