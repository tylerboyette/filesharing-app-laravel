@extends("layouts.master")

@section("content")
    <h2>{{ $user->username }}'s profile @if (Auth::check() && Auth::user()->id === $user->id) {{ "(this is you)" }} @endif</h2>

    @if (Auth::check() && Auth::user()->id === $user->id)
        <form action="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="avatar">Upload avatar</label>
                <input class="form-control" type="file" id="avatar" name="avatar" accept=".png, .jpg, .jpeg">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    @endif
@endsection