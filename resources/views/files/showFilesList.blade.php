@extends("layouts.master")

@section("content")
    <ul>
        @foreach ($files as $file)
            <li>{{ $file->original_name }}</li>
        @endforeach
    </ul>
@endsection
