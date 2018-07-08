@extends("layouts.master")

@section("content")
    <h3>{{ $file->original_name }}</h3>

    <a href="/download/{{ $file->id }}/{{ $file->original_name }}">Скачать</a>
@endsection