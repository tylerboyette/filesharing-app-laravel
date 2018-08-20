@extends("layouts.master")

@section("content")
    <ul class="list-group file-list">
        @foreach ($files as $file)
            <li class="list-group-item file-list__item">
                <div class="media">
                    <div class="media-left mr-3">
                        @if($file->user_id)
                            <img class="uploader-avatar" src="{{ asset("storage/avatars/{$file->user->avatar_name}") }}" alt="Avatar">
                        @else
                            <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="">
                        @endif
                    </div>
                    <div class="media-body">
                        <div class="file-info file-info--margin-bot">
                            <div class="file-info__uploader-name">
                                <b>{{ $file->user_id ? $file->user->username : "Anonymous" }}</b>
                            </div>
                            <div class="file-info__file-name">
                                <span>{{ $file->original_name }}</span>
                            </div>
                        </div>
                        @if (array_key_exists("mime_type", $file->meta_data) && explode("/", $file->meta_data["mime_type"])[0] === "image")
                            <div class="image-preview mb-2">
                                <img class="img-fluid" src="{{ asset("storage/image_previews/$file->storage_name") }}" alt="Thumbnail">
                            </div>
                        @endif

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
                                <span>{{ $file->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
