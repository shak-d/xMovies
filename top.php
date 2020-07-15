<body>
	<nav class="navbar navbar-light navbar-expand mb-5 border-bottom">
    <div class="d-flex flex-grow-1">
        <a class="navbar-brand d-none d-lg-inline-block font-weight-bold" href="#">
            xMovies
        </a>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a href="/explore.php" class="nav-link m-2 menu-item">Explore</a>
            </li>

            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle m-2" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION["name"]?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/watchlist.php">Watchlist</a>
          <a class="dropdown-item" href="/users/signout.php">Sign out</a>
        </div>
      </li>
        </ul>
    </div>
	</nav>