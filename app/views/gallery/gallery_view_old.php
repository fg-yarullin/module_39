<?php $title = 'Галерея изображений'?>

<div class="gallery">
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
  <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
  
    <form action="" method="post" class="imgform">
      <input type="text" name="image[id]" value="<?=$data[$i]['id']; ?>" hidden>
      <a href="#"> 
          <img  src="<?=$data[$i]['path']?>"
                class="w-100 shadow-1-strong rounded mb-4"
                alt="<?=$data[$i]['name']?>"/>
      </a>      
    </form>

    <?php if (isset($data[$i+1])): ?>

      <form action="" method="post">
        <input type="text" name="image[id]" value="<?=$data[$i+1]['id']; ?>" hidden>
        <a href="#">
          <img  src="<?=$data[$i+1]['path']?>"
                class="w-100 shadow-1-strong rounded mb-4"
                alt="<?=$data[$i+1]['name']?>"/>
        </a>
      </form>

    <?php endif?>

  </div>
<?php endfor?>
</div>
<!-- Gallery -->