<p>
    Всего <?=$totalOffers?> offers have been submitted to the Offer Database.
</p>

<div class="offerlist">
    <ul class="categories">
        <?php foreach ($categories as $category): ?>
            <li>
                <a href="/offer/list?category=<?=$category->id?>"><?=$category->name?></a>
            <li>
        <?php endforeach; ?>
    </ul>

    <div class="offers">
    <?php
    $i = 0;
    foreach ($offers as $offer) : ?>
        <blockquote>
            <p>
                <?= ++$i . '.' ?>
                <?=(new Models\Markdown($offer->offertext))->toHtml(); ?>
                (by
                <a href="mailto:<?= htmlspecialchars($offer->getUser()->email, ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($offer->getUser()->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
                on
                <?php
                    $date = new DateTime($offer->offerdate);
                    echo $date->format('jS F Y');
                ?>)
            </p>
            <?php if ($user): ?>
                <div class="item-btns">
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
            <?php endif; ?>
        </blockquote>
    <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation" class="d-flex justify-content-center">
        <ul class="pagination">
            <?php
            $numPages = ceil($totalOffers/5);
            for ($i = 1; $i <= $numPages; $i++): if ($i == $currentPage): ?>
                <li class="page-item">
                    <a class="page-link currentpage" href="/offer/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : ''?>"><?=$i?></a>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="/offer/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : ''?>"><?=$i?></a>
                </li>
            <?php endif?>
            <?php endfor; ?>
        </ul>
    </nav>

</div>
