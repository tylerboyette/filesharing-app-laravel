@extends("layouts.master")

@section("content")
    <h1>Register</h1>

    <form method="post" class="register-form" action="/register">
        {{ csrf_field() }}
        
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control @if ($errors->has("username")){{ "is-invalid" }}@endif"
                   id="username" name="username" value="{{ old("username") }}">
            @if ($errors->has("username"))
                <div class="invalid-feedback">{{ $errors->first("username") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control @if ($errors->has("email")){{ "is-invalid" }}@endif"
                   id="email" name="email" value="{{ old("email") }}">
            @if ($errors->has("email"))
                <div class="invalid-feedback">{{ $errors->first("email") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control @if ($errors->has("email")){{ "is-invalid" }}@endif"
                   id="password" name="password">
            @if ($errors->has("password"))
                <div class="invalid-feedback">{{ $errors->first("password") }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm your password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
@endsection