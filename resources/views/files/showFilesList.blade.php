@extends("layouts.master")

@section("content")
    <ul class="list-group">
        @foreach ($files as $file)
            <li class="list-group-item">
                <div class="media">
                    <div class="media-body">
                        <div class="file-info">
                            <div class="file-info__uploader-name">
                                <b>{{ $file->user_id ? $file->user->username : "Anonymous" }}</b>
                            </div>
                            <div class="file-info__file-name">
                                @if ($file->has_related_icon)
                                    <span class="fiv-viv fiv-icon-{{ $file->extension }}"></span>
                                @else
                                    <span class="fiv-viv fiv-icon-blank"></span>
                                @endif
                                <span>{{ $file->original_name }}</span>
                                <span class="file-info__file-size">({{ $file->meta_data["filesize"]/1000 > 1000 ? round($file->meta_data['filesize']/1000000, 2) . " MB" : round($file->meta_data['filesize']/1000, 2) . " KB" }})</span>
                            </div>
                        </div>
                        @if (explode("/", $file->meta_data["mime_type"])[0] === "image")
                            <div class="image-preview">
                                <img src="{{ asset("storage/image_previews/$file->avatar_name") }}" alt="">
                            </div>
                        @endif    
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
