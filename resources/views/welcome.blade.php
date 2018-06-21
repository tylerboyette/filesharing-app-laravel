@extends ("layouts.master")

@section ("content")
    <form action="/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="file">Upload a file</label>
            <input type="file" name="file" id="file" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection