<p>
    Всего <?=$totalOffers?> offers have been submitted to the Offer Database.
</p>

<div class="d-flex">
<ul class="categories">
    <li>Категории:</li>
    <li>
        <a class="categories__link" href="/offer/list">Все</a>
    </li>
    <?php foreach ($categories as $category): ?>
        <li>
            <a class="categories__link" href="/offer/list?category=<?=$category->id?>"><?=$category->name?></a>
        <li>
    <?php endforeach; ?>
</ul>

<table class="table table-striped table-hover table-bordered align-middle">
    <thead>
        <tr class="align-middle">
        <th>№</th>
        <th>Имя офера</th>
        <th>Целевой URL</th>
        <th>Описание</th>
        <th>Стоимость перехода</th>
        <th>Количество подписчиков</th>
        <th>Состояние</th>
        <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    // var_dump($offers[0]->getUser());exit();
    foreach ($offers as $offer) : ?>
        <tr>
            <td><?= ++$i . '.' ?></td>
            <td class="offer__text">
                <?=(new Models\Markdown($offer->offertext))->toHtml(); ?>
                (by
                <a class="offer__owner-email" href="mailto:<?= htmlspecialchars($offer->getUser()->email, ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($offer->getUser()->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
                on
                <?php
                    $date = new DateTime($offer->offerdate);
                    echo $date->format('jS F Y');
                ?>)
            </td>
            <td>localhost:8081</td>
            <td>Еще нет</td>
            <td>Цена не определена</td>
            <td>Не известно</td>
            <td class="text-center">
                <?php if ($offer->is_active):?>
                    активный
                <?php else: ?>
                    не активный
                <?php endif ?>
            </td>
            <td>
            <?php if ($user): ?>
                <div class="offer__btns">
                    <div class="offer__btns-wraper">
                        <?php if ($offer->userId == $user->id || $user->hasPermission(\Models\User::EDIT_OFFERS)) : ?>
                            <a class="btn btn-outline-secondary" href="/offer/edit?id=<?=$offer->id?>">Edit</a>
                        <?php endif?>
                        <?php if ($offer->userId == $user->id || $user->hasPermission(\Models\User::DELETE_OFFERS)): ?>
                            <form action="/offer/delete" method="post">
                                <input type="hidden" name="id" value="<?= $offer->id ?>">
                                <input class="btn btn-outline-danger ml-2" type="submit"value="Delete">
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </div>
    </tbody>
    <tfoot>
        <tr>
        </tr>
    </tfoot>
</table>
</div>

<?php if ($user && ($user->role == 'web_master' || $user->role == 'admin')): ?>
    <div class="ml-5">
        <a class="btn btn-primary" href="/offer/edit">Добавить предложение</a>
    </div>
<?php endif ?>

<nav aria-label="Page navigation" class="d-flex justify-content-center">
    <ul class="pagination">
        <?php
        $numPages = ceil($totalOffers/5);
        if ($numPages > 1) {}
        for ($i = 1; $i <= $numPages; $i++): if ($i == $currentPage): ?>
            <li class="page-item">
                <a class="page-link currentpage" href="/offer/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : ''?>"><?=$i?></a>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="/offer/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : ''?>"><?=$i?></a>
            </li>
        <?php endif ?>
        <?php endfor; ?>
    </ul>
</nav>

