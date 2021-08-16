<?php extract($data); ?>
<div class="row justify-content-center pt-5 pb-3 m-0">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <?php if ('Session::has message' === 'Session::has message__'): ?>
                        <p class="alert alert-info"></p>
                    <?php endif ?>
                    <form method="POST" action="">
                        <!-- csrf_field -->
                        <input type="hidden" name="token" value="<?=$token?>">

                        <h5 class="text-muted">Вход</h5>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input name="email" type="text" class="form-control" required autofocus placeholder="Email" value="<?=$_POST['email'] ?? ''?>">
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger form-control py-2">
                                <?=$error; ?>
                            </div>
                        <?php endif ?>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input name="password" type="password" class="form-control" required placeholder="Пароль">
                            <?php if ('password' === 'password'): ?>
                                <div class="invalid-feedback">
                                    error password
                                </div>
                            <?php endif ?>
                        </div>

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    Запомни меня
                                </label>
                            </div>
                        </div>

                        <div class="row ml-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary px-4">
                                    Войти
                                </button>
                            </div>
                            <div class="text-right ml-5">
                                <a class="btn btn-outline-secondary" href="<?=$vkOauth?>">
                                    Войти через ВКонтакте
                                </a>
                            </div>
                            <!-- <div class="text-right ml-5">
                                <a class="btn btn-link" href="#">
                                    Забыл пароль?
                                </a>
                            </div>
                            <div class="text-right ml-5">
                                <a class="btn btn-link" href="/user/register">
                                    Регистрация
                                </a>
                            </div> -->
                        </div>

                    </form>
                    <p class="mt-3 pt-2">
                        Нет учетной записи?
                        <a href="/user/register">
                            Тогда вам сюда
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

