<div class="container-fluid">
    <?php if (empty($offer->id) || $offer->userId == $user->id &&
    $user->hasPermission(\Models\User::EDIT_OFFERS)): ?>
        <form action="" method="post">
            
            <fieldset>
                <input type="hidden" name="offer[id]" value="<?=$offer->id ?? '';?>">
                <div class="mb-3">
                    
                    <label for="offertext" class="form-label">Type your offer here:</label>
                    <textarea class="form-control" id="offertext" name="offer[offertext]" id="offertext" cols="40" rows="3"><?=$offer->offertext ?? '';?></textarea>
                </div>                
                <div class="mb-3">
                    <?php if($offer->is_active): ?>
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                        checked value="<?=$offer->is_active?>">
                    <?php else: ?>
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                        value="<?=$offer->is_active ?>">
                    <?php endif ?>
                    <label class="form-check-label" for="is_active">Активный</label>
                </div>

                <legend>Выберите категорию предложения:</legend>
                <?php foreach ($categories as $category): ?>
                    <div class="mb-2 set_categories">
                        <?php if ($offer && $offer->hasCategory($category->id)):?>
                            <input class="form-check-input" type="checkbox" checked name="category[]"
                            value="<?=$category->id?>">
                        <?php else:?>
                            <input class="form-check-input"type="checkbox" name="category[]"
                            value="<?=$category->id?>">
                        <?php endif?>
                        <label class="form-check-label"><?=$category->name?></label>
                    </div>
                <?php endforeach?>
                <input class="btn btn-primary my-3" type="submit" value="Сохранить">
            </fieldset>
        </form>
    <?php else: ?>
    <p>You may only edit jokes that you posted.</p>
    <?php endif; ?>
</div>
