@extends("layouts.master")

@section("content")
    <div class="profile mt-4">
        <div class="row">
            <div class="col-4">
                <div class="profile-left">
                    @include("users.partials.card")
                </div>
            </div>
            <div class="col">
                <div class="profile-right">
                    @if ($files->count())
                        <ul class="list-group">
                            <li class="list-group-item"><h5 class="text-center">Files uploaded by {{ $user->username }}</h5></li>
                            @each("files.partials.file.list-item", $files, "file")
                        </ul>
                    @else
                        <div class="text-center">
                            User has not uploaded any files yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (Auth::check() && Auth::user()->id === $user->id)
        @include("users.partials.avatar-modal")
    @endif
@endsection