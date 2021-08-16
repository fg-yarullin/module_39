<?php
    extract($data);
//   var_dump($_SESSION);
?>

<div id="gallery_imageview">
    <div class="text-center">
        <h4 class="text-center"><?=$image['name']?></h4>
        <img
        id="selectedimage"
        idindb="<?=$image['id'] ?>"
        src="<?=$image['path'] ?>"
        class="h-50 rounded mb-4"
        alt="<?=$image['name']?>"
        />
        
            <?php if ($image['isVerified'] && ($authUserId == $image['user_id'])): ?>
            <div class="d-flex d-column justify-content-center mb-3">
                <form action="gallery/delete" method="post">
                    <input type="hidden" name="id" value="<?= $image['id']?>">
                    <input type="hidden" name="path" value="<?= $image['path']?>">
                    <button class="btn btn-outline-danger" type="submit" name="submit">
                        Delete picture
                    </button>
                </form>
            </div>
            <?php endif ?>
    </div>
    <div class="commemts mx-5">
        <h5 class="mx-5">
            Comments:
        </h5>
        <?php if ($image['isGuest']): ?>
            <p class="px-5">
                <a href="/user/register">Register an account</a>
                or
                <a href="/user/login">Log in</a>
                to post a comment!
            </p>
        <?php endif ?>
        <hr>
        <?php if (count($comments) > 0): ?>
        
            <?php foreach ($comments as $comment): ?>
            <div id="parentdiv<?=$comment['id']?>">
                <div>
                    <p>
                    <?=$comment['text']?>
                        <span class="text-muted">
                            <?= "<br>Author:  Uid-{$comment['user_id']}, Date:  {$comment['date']}, "?>
                        </span>
                    </p>
                    <?php if ($image['isVerified'] && ($authUserId == $comment['user_id'])): ?>
                        <div id="<?=$comment['id']?>">
                            <button class="btn btn-sm btn-outline-secondary comment-btn" type="submit"
                            name="delete" id="d<?=$comment['id']?>">
                                Delete
                            </button>
                        </div>
                    <?php endif ?>
                </div>
                <hr>
            </div>
            <?php endforeach?>

        <?php else: ?>
            <p>There is no comments yet. You can be first!</p>
            <?php if ($image['isGuest']): ?>
                <p>
                <a href="/user/register">Register to post one!</a>
                </p>
            <?php endif?>
        <?php endif ?>
    </div>
</div>

<?php if (!$image['isGuest']): ?>
    <form class="addcomment ml-5" action="" method="post">
    <input type="hidden" name="image_id" value="<?=$image['id'] ?>">
    <input type="hidden" name="author_id" value="<?=$authUserId ?>" id="author_id">

    <label class="ml-3" for="comment">Add a new comment (at least 5 characters)</label>

    <textarea id="comment_text" class="mt-1" name="comment" id="comment"
              rows="3" cols="80" placeholder="Your comment"></textarea>

<!--    <input class="btn btn-outline-secondary" type="submit" value="Form Submit">-->

    <button id="addcomment" class="btn btn-outline-secondary comment-btn" name="add">
        Submit
    </button>
</form>
<?php endif ?>

<!--<div id="success" class="alert alert-success my-3 mx-5"></div>-->
