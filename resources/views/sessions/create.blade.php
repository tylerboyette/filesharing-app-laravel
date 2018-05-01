@extends("layouts.master")

@section("content")
    <h1>Sign In</h1>

    <form method="post" action="/login">
        {{ csrf_field() }}

        @if (count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    {{ $errors->first("message") }}
                </div>
            </div>
        @endif

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sign In</button>
        </div>

    </form>
@endsection