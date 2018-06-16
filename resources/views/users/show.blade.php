@extends("layouts.master")

@section("content")
    <img src="/uploads/avatars/{{ $user->avatar_name }}" class="avatar" alt="Avatar">
    <h2>{{ $user->username }}'s profile @if (Auth::check() && Auth::user()->id === $user->id) {{ "(this is you)" }} @endif</h2>

    @if (Auth::check() && Auth::user()->id === $user->id)
        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="avatar">Upload avatar</label>
                <input class="form-control" type="file" id="avatar" name="avatar" accept=".png, .jpg, .jpeg">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>

            @if ($errors->has("avatar"))
                <div class="invalid-feedback">{{ $errors->first("avatar") }}</div>
            @endif
        </form>
    @endif
@endsection