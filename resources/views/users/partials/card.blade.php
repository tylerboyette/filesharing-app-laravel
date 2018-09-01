<div class="card bg-light text-center h-100">
    <div class="card-body d-flex justify-content-center align-items-center">
        <div>
            @include("users.partials.avatar")
            <h5>{{ $user->username }}</h5>
            <p class="card-text">Files: {{ $fileCount }}</p>
            @if (Auth::check() && Auth::user()->id === $user->id)
                <a href="" data-toggle="modal" data-target="#avatarModal">Change avatar</a>
            @endif
        </div>
    </div>
</div>