@extends ("layouts.master")

@section ("content")
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Upload a file</label>
            <input type="file" name="file" id="file" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@endsection