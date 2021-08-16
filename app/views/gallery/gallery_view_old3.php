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

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="row">
<?php for ($i = 0; $i < count($data); $i+=2): ?>
  <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 gallery-img">

  <img  src="<?=$data[$i]['path']?>"
    id="<?=$data[$i]['id']; ?>"
    class="w-100 shadow-1-strong rounded mb-4"
    alt="<?=$data[$i]['name']?>"/>
<!-- <div class="row bg-dark">ddd</div> -->
    <?php if (isset($data[$i+1])): ?>

  <img  src="<?=$data[$i+1]['path']?>"
    id="<?=$data[$i+1]['id']; ?>"
    class="w-100 shadow-1-strong rounded mb-4"
    alt="<?=$data[$i]['name']?>"/>

    <?php endif?>

  </div>
<?php endfor?>
</div>
<!-- Gallery -->


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="container text-center my-3">
<h2 class="font-weight-light">Bootstrap 4 - Multi Item Carousel</h2>
<div class="row mx-auto my-auto">
    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
            <div class="carousel-item active">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=1">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=2">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=3">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=4">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=5">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-4">
                    <div class="card card-body">
                        <img class="img-fluid" src="http://placehold.it/380?text=6">
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<h5 class="mt-2">Advances one slide at a time</h5></div>
