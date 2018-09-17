<div class="file mt-2 mb-2">
    <div class="media">
        <div class="media-left mr-3">
            @if($file->user_id)
                <a href="/users/{{ $file->user_id }}">
                    <img class="uploader-avatar" src="{{ asset("storage/avatars/{$file->user->avatar_name}") }}" alt="Avatar">
                </a>
            @else
                <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="">
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
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Details</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>General</b></td>
                        </tr>
                        <tr>
                            <td>Format:</td>
                            <td>{{ strtoupper($file->meta_data["fileformat"]) }}</td>
                        </tr>
                        <tr>
                            <td>Size:</td>
                            <td>{{ $file->meta_data["video"]["resolution_x"]."x".$file->meta_data["video"]["resolution_y"] }}</td>
                        </tr>
                        <tr>
                            <td>Color depth:</td>
                            <td>{{ $file->meta_data["video"]["bits_per_sample"]."-bit" }}</td>
                        </tr>
                    </table>
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "audio")
                <div class="audio-preview mb-2">
                    <audio src="/download/{{ $file->id }}/{{ $file->original_name }}"></audio>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Details</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>General</b></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td>{{ $file->meta_data["playtime_string"] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Audio</b></td>
                        </tr>
                        <tr>
                            <td>Bitrate:</td>
                            <td>{{ round($file->meta_data["audio"]["bitrate"]/1000) . " kbit/s" }}</td>
                        </tr>
                        <tr>
                            <td>Sampling rate:</td>
                            <td>{{ $file->meta_data["audio"]["sample_rate"]/1000 . " kHz" }}</td>
                        </tr>
                        <tr>
                            <td>Channels count:</td>
                            <td>{{ $file->meta_data["audio"]["channels_count"] }}</td>
                        </tr>
                        <tr>
                            <td>Codec:</td>
                            <td>{{ $file->meta_data["audio"]["codec"] }}</td>
                        </tr>
                    </table>
                </div>
            @elseif (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "video")
                <div class="video-preview mb-2">
                    <video>
                        <source src="/download/{{ $file->id }}/{{ $file->original_name }}" type="{{ $file->meta_data["mime_type"] }}">
                    </video>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary details-button mb-2">Details</button>
                <div class="details-table">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><b>General</b></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td>{{ $file->meta_data["playtime_string"] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Video</b></td>
                        </tr>
                        <tr>
                            <td>Size:</td>
                            <td>{{ $file->meta_data["video"]["resolution_x"]."x".$file->meta_data["video"]["resolution_y"] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Audio</b></td>
                        </tr>
                        <tr>
                            <td>Sampling rate:</td>
                            <td>{{ $file->meta_data["audio"]["sample_rate"]/1000 . " kHz" }}</td>
                        </tr>
                        <tr>
                            <td>Channels count:</td>
                            <td>{{ $file->meta_data["audio"]["channels_count"] }}</td>
                        </tr>
                        <tr>
                            <td>Codec:</td>
                            <td>{{ $file->meta_data["audio"]["codec"] }}</td>
                        </tr>
                    </table>
                </div>
            @endif
            @include("files.partials.file.card")
            <a class="btn btn-primary" href="/download/{{ $file->id }}/{{ $file->original_name }}" role="button">Download</a>
        </div>
    </div>
</div>