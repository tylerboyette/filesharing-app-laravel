@extends("layouts.master")

@section("content")
    @include("files.partials.file.list")
    <div class="d-flex justify-content-center">
        {{ $files->links() }}
    </div>
@endsection
