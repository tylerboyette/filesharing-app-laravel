@extends("layouts.master")

@section("content")
    <ul class="list-group file-list">
        @foreach ($files as $file)
            <li class="list-group-item file-list__item">
                <div class="media file-card">
                    <div class="media-left mr-3">
                        @if($file->user_id)
                            <img class="uploader-avatar" src="{{ asset("storage/avatars/{$file->user->avatar_name}") }}" alt="Avatar">
                        @else
                            <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="">
                        @endif
                    </div>
                    <div class="media-body">
                        <div class="file-info">
                            <div class="file-info__uploader-name">
                                <b>{{ $file->user_id ? $file->user->username : "Anonymous" }}</b>
                            </div>
                            <div class="file-info__file-name">
                                @if ($file->has_related_icon)
                                    <span class="fiv-viv fiv-icon-{{ $file->extension }} file-icon"></span>
                                @else
                                    <span class="fiv-viv fiv-icon-blank file-icon"></span>
                                @endif
                                <span>{{ $file->original_name }}</span>
                                <span class="file-info__file-size">({{ $file->meta_data["filesize"]/1000 > 1000 ? round($file->meta_data['filesize']/1000000, 2) . " MB" : round($file->meta_data['filesize']/1000, 2) . " KB" }})</span>
                            </div>
                        </div>
                        @if (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "image")
                            <div class="image-preview">
                                <img class="img-fluid" src="{{ asset("storage/image_previews/$file->storage_name") }}" alt="Thumbnail">
                            </div>
                        @endif    
                    </div>
                </div>
                <div class="file-info-bottom"></div>
            </li>
        @endforeach
    </ul>
@endsection
