<p>
    <?=$totalOffers?> offers have been submitted to the Offer Database.
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
    foreach ($offers as $offer) : ?>
        <blockquote>
            <p>
                <?= htmlspecialchars($offer->id, ENT_QUOTES, 'UTF-8') ?>
                <?= htmlspecialchars($offer->offertext, ENT_QUOTES, 'UTF-8')?>
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
                <?php if ($offer->userId == $user->id || $user->hasPermission(\Models\User::EDIT_OFFERS)) : ?>
                    <a class="btn btn-outline-secondary"
                    href="/offer/edit?id=<?=$offer->id?>">Edit</a>
                <?php endif?>
                <?php if ($offer->userId == $user->id || $user->hasPermission(\Models\User::DELETE_OFFERS)): ?>
                    <form action="/offer/delete" method="post">
                        <input type="hidden" name="id" value="<?= $offer->id ?>">
                        <input class="btn btn-outline-danger ml-2"
                        type="submit"value="Delete">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </blockquote>
    <?php endforeach; ?>
</div>
