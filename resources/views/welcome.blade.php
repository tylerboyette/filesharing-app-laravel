@extends ("layouts.master")

@section ("content")
            <form action="/upload" id="file-upload-form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <input id="file-input" name="file" type="file" class="file" data-show-preview="false">
                </div>
            </form>
@endsection