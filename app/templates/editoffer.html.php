<?php if (empty($offer->id) || $offer->userId == $user->id &&
$user->hasPermission(\Models\User::EDIT_OFFERS)): ?>
    <form action="" method="post">
        <input type="hidden" name="offer[id]" value="<?=$offer->id ?? '';?>">
        <label for="offertext">Type your offer here:</label>
        <textarea name="offer[offertext]" id="offertext" cols="40" rows="3"><?=$offer->offertext ?? '';?></textarea>

        <p>Select category for this offer:</p>
        <?php foreach ($categories as $category): ?>
            <div class="set_categories">
                <?php if ($offer && $offer->hasCategory($category->id)):?>
                    <input type="checkbox" checked name="category[]"
                    value="<?=$category->id?>">
                <?php else:?>
                    <input type="checkbox" name="category[]"
                    value="<?=$category->id?>">
                <?php endif?>
                <label><?=$category->name?></label>
            </div>
        <?php endforeach?>
        <input class="btn btn-secondary" type="submit" value="Save">
    </form>
<?php else: ?>
<p>You may only edit jokes that you posted.</p>
<?php endif; ?>


