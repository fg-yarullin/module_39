<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Offers</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/offer/list">Предложения</a>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="/offer/edit">Добавить предложение</a>
                    </li> -->
                    <?php if ($loggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <? echo ucfirst(explode('@', $_SESSION['email'])[0]) ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/admin">Админ</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li ><a class="dropdown-item" href="/logout">Выход</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><span class="dropdown-item">(Роль: <? print($_SESSION['role'])?>)</span></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login">Вход</a></li>
                    <?php endif; ?>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>-->
<!--                    </li>-->
                </ul>
<!--
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
-->
            </div>
        </div>
    </nav>
