@extends("layouts.master")

@section("content")
    <img src="{{ asset("storage/avatars/$user->avatar_name") }}" class="avatar" alt="Avatar">
    <h2>
        {{ $user->username }}'s profile @if (Auth::check() && Auth::user()->id === $user->id) {{ "(this is you)" }} @endif
    </h2>

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
    <ul class="user-files">
        @foreach($user->files as $file)
            <li>
                <div class="file-card file-card--flex bg-light">
                    <div class="file-card__icon mr-2">
                        @if ($file->has_related_icon)
                            <span class="fiv-viv fiv-icon-{{ $file->extension }} file-icon"></span>
                        @else
                            <span class="fiv-viv fiv-icon-blank file-icon"></span>
                        @endif
                    </div>
                    <div class="file-card__info file-card__info--flex">
                                <span>
                                    <b>{{ $file->original_name }}</b>
                                    <i>({{ $file->meta_data["filesize"]/1000 > 1000 ? round($file->meta_data['filesize']/1000000, 2) . " MB" : round($file->meta_data['filesize']/1000, 2) . " KB" }})</i>
                                </span>
                        <span>Uploaded {{ $file->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection