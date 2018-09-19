@extends("layouts.master")

@section("content")
    @if ($files->count())
        @include("files.partials.file.list")
        <div class="d-flex justify-content-center">
            {{ $files->links() }}
        </div>
    @else
        @include("files.partials.file.no-files")
    @endif
@endsection
