<a href="/files/{{ $file->id }}" class="show-file-link">
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
</a>