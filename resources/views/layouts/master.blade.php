<!doctype html>
<html lang="en">
<head>
    <title>File Sharing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
    @include("layouts.nav")

    <main role="main" class="container">
        @yield("content")

        <div class="modal" id="registerModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" class="register-form" action="/register">
                        <div class="modal-header">
                            <h5 class="modal-title">Registration</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control"
                                           id="username" name="username">
                                    <div class="invalid-feedback username-error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control"
                                           id="email" name="email">
                                    <div class="invalid-feedback email-error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control"
                                           id="password" name="password">
                                    <div class="invalid-feedback password-error"></div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm your password:</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="modal" id="loginModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" class="login-form" action="/login">
                        <div class="modal-header">
                            <h5 class="modal-title">Logging in</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="loginEmail">Email:</label>
                                <input type="email" name="email" class="form-control" id="loginEmail">
                                <div class="invalid-feedback email-error"></div>
                            </div>

                            <div class="form-group">
                                <label for="loginPassword">Password:</label>
                                <input type="password" name="password" class="form-control" id="loginPassword">
                                <div class="invalid-feedback password-error"></div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <script src="{{ asset("js/app.js") }}"></script>
</body>
</html>