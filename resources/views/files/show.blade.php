@extends("layouts.master")

@section("content")
    <div class="file mt-2 mb-2">
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
                <div class="file-card file-card--flex bg-light mb-2">
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
                <a class="btn btn-primary" href="/download/{{ $file->id }}/{{ $file->original_name }}" role="button">Download</a>
            </div>
        </div>
    </div>

    <div class="comment-section bg-light">
            <form action="/comments" method="post" id="comment-form">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea class="form-control" rows="3" id="comment-content" name="content" placeholder="Add a comment..."></textarea>
                    <input type="hidden" name="file_id" id="comment-file_id" value="{{ $file->id }}">
                    <div class="invalid-feedback comment-content-error"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add a comment</button>
                </div>
            </form>
            <ul class="list-group">
                @foreach($file->comments as $comment)
                    <li class="list-group-item">
                        <div class="media">
                            <div class="media-left mr-3">
                                @if ($comment->user)
                                    <img class="uploader-avatar" src="{{ asset("storage/avatars/{$comment->user->avatar_name}") }}" alt="Avatar">
                                @else
                                    <img class="uploader-avatar" src="{{ asset("storage/avatars/anon.jpg") }}" alt="Avatar">
                                @endif
                            </div>
                            <div class="media-body">
                                <div class="comment-info">
                                    <span class="comment-info__author-name"><b>{{ $comment->user ? $comment->user->username : "Anonymous" }}</b></span>
                                    <span class="comment-info__date">{{ $comment->created_at->format("M j, Y H:i") }}</span>
                                    <div class="comment-content mb-2">
                                        {{ $comment->content }}
                                    </div>
                                    <span class="reply-link">Reply</span>
                                    <div class="reply-form">
                                        <form action="/comments" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <textarea class="form-control" rows="3" id="comment-content" name="content" placeholder="Add a reply..."></textarea>
                                                <input type="hidden" name="file_id" id="comment-file_id" value="{{ $file->id }}">
                                                <div class="invalid-feedback comment-content-error"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Add a comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
    </div>
@endsection