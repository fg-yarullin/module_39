<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand ml-3" href="#">Module 27</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-3" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li  class="nav-item">
                <a class="nav-link" href="/portfolio">Portfolio</a>
            </li>
            <li  class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li  class="nav-item">
                <a class="nav-link" href="/contacts">Contacts</a>
            </li>
            <li  class="nav-item">
                <a class="nav-link" href="/gallery">Gallery</a>
            </li>
            <li  class="nav-item">
                <a class="nav-link" href="/user">Users</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto mr-3">
            <?php if (1 == 1): /*if guest */?>
                <li class="nav-item">
                    <a class="nav-link" href="login">
                        <i class="nav-icon fas fa-fw fa-sign-in-alt" style="color: #aaa"></i>
                        Вход
                    </a>
                </li>
            <?php else: /*if logged in */ ?>
                <li class="nav-item">
                    <a 
                        class="nav-link"
                        href="logout"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        <i class="nav-icon fas fa-fw fa-sign-out-alt" style="color: #aaa"></i>
                        Выход
                    </a>
                </li>
            <?php endif ?>       
        </ul>
        <form id="logout-form" action="logout" method="POST" style="display: none;">
            <!-- @csrf -->
        </form>
    </div>
</nav>
