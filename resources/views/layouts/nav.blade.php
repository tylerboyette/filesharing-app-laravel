<nav class="navbar navbar-expand-md navbar-light bg-light navbar--shadow">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/files">Files</a>
            </li>
        </ul>
        @guest
            <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="#loginModal" data-toggle="modal" data-target="#loginModal">Sign In</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#registerModal" data-toggle="modal" data-target="#registerModal">Sign Up</a>
                </li>
            </ul>
        @endguest

        @auth
            <ul class="nav navbar-nav navbar-right profile-dropdown-container">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">Profile</a>
                        <a class="dropdown-item" href="/logout">Sign Out</a>
                    </div>
                </li>
            </ul>
        @endauth
        <div class="ml-3">
            <form action="/files" class="form-inline my-2 my-lg-0" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search by file name" aria-label="Search" name="search">
            </form>
        </div>
    </div>
</nav>