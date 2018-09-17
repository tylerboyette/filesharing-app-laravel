<li class="list-group-item file-list__item">
    <div class="media">
        <div class="media-left mr-3">
            @if($file->user_id)
                <a href="/users/{{ $file->user_id }}">
                    <img class="uploader-avatar" src="{{ asset("storage/avatars/{$file->user->avatar_name}") }}" alt="Avatar">
                </a>
            @else
                <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="Avatar">
            @endif
        </div>
        <div class="media-body">
            <div class="file-info file-info--margin-bot">
                <div class="file-info__uploader-name">
                    @if ($file->user_id)
                        <a href="/users/{{ $file->user_id }}" class="show-profile-link"><b>{{ $file->user->username }}</b></a>
                    @else
                        <b>Anonymous</b>
                    @endif
                </div>
                <div class="file-info__file-name">
                    <span>{{ $file->original_name }}</span>
                </div>
            </div>
            @if (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "image")
                <div class="image-preview mb-2">
                    <img class="img-fluid" src="{{ asset("storage/image_previews/$file->storage_name") }}" alt="{{ $file->original_name }}">
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "audio")
                <div class="audio-preview mb-2">
                    <audio src="/download/{{ $file->id }}/{{ $file->original_name }}"></audio>
                </div>

            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "video")
                <div class="video-preview mb-2">
                    <video>
                        <source src="/download/{{ $file->id }}/{{ $file->original_name }}" type="{{ $file->meta_data["mime_type"] }}">
                    </video>
                </div>
            @endif
            @include("files.partials.file.card")
        </div>
    </div>
</li>