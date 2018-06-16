<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="/login">Sign In</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/register">Sign Up</a>
                </li>
            @endif

            @if (Auth::check())
                <li class="nav-item">
                    <a href="/users/{{ Auth::user()->id }}" class="nav-link">{{ Auth::user()->username }}</a>
                </li>

                <li class="nav-item">
                    <a href="/logout" class="nav-link">Sign Out</a>
                </li>
            @endif
        </ul>
    </div>
</nav>