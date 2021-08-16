<h2>Categories</h2>
<a href="/category/edit">Add a new category</a>
<?php foreach ($categories as $category) : ?>
    <blockquote>
        <p>
            <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>
            <a class="btn btn-outline-secondary" href="/category/edit?id=<?=$category->id ?>">Edit</a>
            <form action="/category/delete" method="post">
                <input type="hidden" name="id" value="<?= $category->id ?>">
                <input class="btn btn-outline-danger ml-2" type="submit" value="Delete">
            </form>
        </p>
    </blockquote>
<?php endforeach; ?>
