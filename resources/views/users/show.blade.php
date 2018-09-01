@extends("layouts.master")

@section("content")
    <div class="profile mt-2">
        <div class="row">
            <div class="col-4">
                <div class="profile-left">
                    @include("users.partials.card")
                </div>
            </div>
            <div class="col">
                <div class="profile-right">
                    <ul class="list-group">
                        @each("files.partials.file.list-item", $files, "file")
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::check() && Auth::user()->id === $user->id)
        @include("users.partials.avatar-modal")
    @endif
@endsection