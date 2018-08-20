@extends("layouts.master")

@section("content")
    <h3>{{ $file->created_at }}</h3>

    <a href="/download/{{ $file->id }}/{{ $file->original_name }}">Скачать</a>
@endsection