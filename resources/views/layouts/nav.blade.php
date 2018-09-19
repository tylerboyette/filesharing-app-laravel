<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="#loginModal" data-toggle="modal" data-target="#loginModal">Sign In</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#registerModal" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                </li>
            @endguest

            @auth
                <li class="nav-item">
                    <a href="/users/{{ Auth::user()->id }}" class="nav-link">{{ Auth::user()->username }}</a>
                </li>

                <li class="nav-item">
                    <a href="/logout" class="nav-link">Sign Out</a>
                </li>
            @endauth
            <li class="nav-item">
                <a class="nav-link" href="/files">Files</a>
            </li>
        </ul>
        <form action="/files" class="form-inline my-2 my-lg-0" method="GET">
            <input class="form-control mr-sm-2" type="search" placeholder="Search by file name" aria-label="Search" name="keyword">
        </form>
    </div>
</nav>