<?php 
    extract($data);
?>

<div class="gallery">
    <h2>
      Галерея
    </h2>
    <p class="text-danger"><?=$isLoggedIn . '-isLoggedIn' ?></p>
    <?php if(isset($message)): ?>
        <p class="text-danger">
            <?= $message ?>
        </p>
    <?php endif ?>
</div>

<!-- Gallery -->
<div class="row mx-3">
    <form action="" enctype="multipart/form-data" method="post">
        <label for="imagefile">Добавьте новый рисунок в галерею</label>
        <input
            type="file" name="fileToUpload" id="fileToUpload"
            accept="image/jpeg,image/png,image/jpg,image/gif"
        >
        <input 
            class="btn btn-outline-secondary mt-3" type="submit"
            value="Отправить" name="submit"
        >
    </form>
</div>