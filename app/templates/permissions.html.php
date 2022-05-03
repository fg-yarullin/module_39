<h2>Измениние прав и роли пользователя <?= $user->name ?></h2>

<form action="" method="post">
    <?php foreach ($permissions as $name => $value) : ?>
        <div class="set_categories">
            <input
                name="permissions[]" type="checkbox" value="<?= $value ?>"
                <?php if ($user->hasPermission($value)) : echo 'checked'; endif; ?>
            >
            <label><?= $name ?></label>
        </div>
    <?php endforeach; ?>
    <input type="submit" value="Submit">
</form>
