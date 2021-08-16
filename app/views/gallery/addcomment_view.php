<?php if (!$image['isGuest']): ?>
    <form class="addcomment ml-5" action="" method="post">
        <input type="hidden" name="image_id" value="<?=$image['id'] ?>">
        <label class="ml-3" for="comment">Add a new comment</label>
        <textarea id="comment_text" class="mt-1" name="comment" id="comment" 
            rows="3" cols="60" placeholder="Your comment"></textarea>
        <input class="btn btn-outline-secondary" type="submit" value="Form Submit">
    </form>
    <button id="addcomment" class="btn btn-outline-secondary comment-btn" name="add">
        AJAX Submit
    </button>
<?php endif ?>