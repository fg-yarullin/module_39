<?php $title = 'Галерея изображений'?>

<div>
    <h2>
      Галерея
      <!-- <a href="/gallery/add">
        <span class="btn btn-lg text-muted ml-3" title="Add Image">
          <i class="far fa-plus-square"></i>
        </span>
      </a> -->
      <a class="text-decoration-none" href="/gallery/add">
        <button class="btn btn-light" type="submit">
            <span class="text-muted mr-1" title="Add Image">
              <i class="far fa-plus-square"></i>
            </span>
            Добавить 
        </button>
      </a>
    </h2>
</div>

<!-- Paging -->
<?php if (count($data) > 0): ?>
<div class="col-md mb-3 d-flex justify-content-center">
    <nav aria-label="Page navigation">
      <ul class="pagination pagination-sm m-0">
          <li class="page-item"><a class="page-link" id="first-page"> &lt;&lt; </a></li>
          <li class="page-item">
              <a class="page-link"> &lt; </a>
          </li>
          <li class="page-item">
              <a class="page-link">page</a>
          </li>
          <li class="page-item">
              <a class="page-link"> &gt; </a>
          </li>
          <li class="page-item"><a class="page-link"> &gt;&gt; </a></li>
      </ul>
    </nav>
</div>
<?php endif?>
<!-- Paging -->

<!-- Gallery -->
<div class="row">
<?php for ($i = 0; $i < count($data); $i+=2): ?>
  <div class="col-lg-4 col-md-12 mb-lg-0 gallery-img">

  <form class="image-form" action="" method="post">
    <input type="hidden" name="image_id" value="<?=$data[$i]['id']?>">
    <!-- <input type="hidden" name="image[name]" value="<?=$data[$i]['name']?>">
    <input type="hidden" name="image[path]" value="<?=$data[$i]['path']?>">
    <input type="hidden" name="image[user_id]" value="<?=$data[$i]['user_id']?>"> -->
    <button class="btn w-100 p-0" type="submit" name="submit">
      <img  src="<?=$data[$i]['path']?>"
        id="<?=$data[$i]['id']; ?>"
        class="h-75 rounded"

        alt="<?=$data[$i]['name']?>"/>
    </button>      
  </form>

<!-- <div class="row bg-dark">ddd</div> -->
    <?php if (isset($data[$i+1])): ?>

      <form class="image-form" action="" method="post">
        <input type="hidden" name="image_id" value="<?=$data[$i+1]['id']?>">
        <!-- <input type="hidden" name="image[name]" value="<?=$data[$i+1]['name']?>">
        <input type="hidden" name="image[path]" value="<?=$data[$i+1]['path']?>">
        <input type="hidden" name="image[user_id]" value="<?=$data[$i+1]['user_id']?>"> -->

        <button class="btn  w-100 p-0" type="submit" name="submit">
          <img  src="<?=$data[$i+1]['path']?>"
            id="<?=$data[$i+1]['id']; ?>"
            class="h-75 rounded"
            alt="<?=$data[$i+1]['name']?>"/>
        </button>      
      </form>

    <?php endif?>

  </div>
<?php endfor?>
</div>
<!-- Gallery -->