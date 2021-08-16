<?php $title = 'Галерея изображений'?>
<div>
  <div class="mt-3">
      <h2>
        Галерея
        <!-- <a href="/gallery/add">
          <span class="btn btn-lg text-muted ml-3" title="Add Image">
            <i class="far fa-plus-square"></i>
          </span>
        </a> -->
        <a class="text-decoration-none" href="/gallery/add">
          <button class="btn btn-outline-secondary" type="submit">
              <span class="mr-1" title="Add Image">
                <i class="far fa-plus-square"></i>
              </span>
              Добавить 
          </button>
        </a>
      </h2>
  </div>

  <!-- Carousel -->

  <div class="carousel mt-4 mx-md-n4">
    <div id="carouselCaptions" data-interval="false" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
        <?php foreach (range(1, count($data) - 1) as $number): ?>
            <li data-target="#carouselCaptions" data-slide-to="<?= $number ?>"></li>
        <?php endforeach?>
      </ol>

      <div class="carousel-inner">
        <div class="carousel-item active mt-2" id="<?= $data[0]['id'] ?>">
          <img class="d-block carusel-picture"
            src="<?= $data[0]['path'] ?>"
            alt="<?= $data[0]['name'] ?>">
        <div class="carousel-caption d-none d-md-block">
            <h5 class="opacity-2"><?= $data[0]['name'] ?></h5>
        </div>
        <form action="" method="post">
            <input type="hidden" name="image[id]" value="<?=$data[0]['id']?>">
            <input type="submit" name="submit" value="Save">
          </form>
        </div>

        <?php for ($i = 1; $i < count($data); $i++): ?>
          <div class="carousel-item  mt-2" id="<?= $data[$i]['id'] ?>">
            <img class="d-block carusel-picture" 
            src="<?= $data[$i]['path'] ?>"
            alt="<?= $data[$i]['name'] ?>">
            <form action="" method="post">
              <input type="hidden" name="image[id]" value="<?=$data[$i]['id']?>">
              <input type="submit" name="submit" value="Save">
            </form>
          <div class="carousel-caption d-none d-md-block opacity-2">
                <h5><?= $data[$i]['name'] ?></h5>


              </div>
          </div>
        <?php endfor?>
      </div>

      <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>

<!-- Carousel -->

<div class="buttons mt-4">
    <button class="btn btn-outline-secondary">Btn1</button>
    <button class="btn btn-outline-secondary">Btn2</button>
    <button class="btn btn-outline-secondary">Btn3</button>
    <button class="btn btn-outline-secondary">Btn4</button>
</div>

<?php $comments = [
    ['text' => 'hjfhdsjkfhsdjkfhksdj',
        'user_id' => 1,
        'date' => '2020-05-05'
    ], 
    ['text' => 'jwekfjiofjweoifoiefwj',
    'user_id' => 2,
    'date' => '2020-05-05'], 
    ['text' => 'wefuhweiufqhweuifhweiuf',
    'user_id' => 3,
    'date' => '2020-05-05']];
?>

<div class="comments mt-4">
    <h4 class="">Comments:<span class="btn text-muted ml-3" title="Add Comment"><i class="far fa-plus-square"></i></span></h4>
    <hr>
    <?php foreach ($comments as $comment): ?>
        <div class="mx-5">
            <p>Comment: <?=$comment['text']?></p>
            <p>
                Author: <?=$comment['user_id']?>, Date: <?=$comment['date']?>
                <span class="btn text-muted ml-3" title="Edit Comment"><i class="fas fa-edit"></i></span>
                <span class="btn text-muted ml-3" title="Delete Comment"><i class="far fa-trash-alt"></i></span>
            </p>
            <p></p>
        </div>
        <hr>
    <?php endforeach?>
</div>

<!-- Paging -->
<?php if (count($data) == 0): ?>
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
