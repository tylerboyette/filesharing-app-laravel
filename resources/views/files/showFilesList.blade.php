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
                                {{ $file->original_name }} <span class="file-info__file-size">({{ $file->meta_data["filesize"]/1000 > 1000 ?
                                                                                                round($file->meta_data['filesize']/1000000, 2) . " MB" :
                                                                                                round($file->meta_data['filesize']/1000, 2) . " KB"}})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
