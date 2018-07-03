@extends ("layouts.master")

@section ("content")
            <form action="/upload" id="file-upload-form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <input id="input-b1" name="input-b1" type="file" class="file">
                </div>
            </form>
@endsection