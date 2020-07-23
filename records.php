<!DOCTYPE html>
<?php

$perPage = $_GET['perPage'] ? $_GET['perPage'] : 10;
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PHPTest — Pagination</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="./assets/css/custom.min.css" media="screen">
  <link rel="stylesheet" href="./assets/css/style.css" media="screen">
</head>

<body>
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand">Test PHP — Pagination</a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
          <li>
            <a href="index.php">Accueil</a>
          </li>
          <li>
            <a href="tasks.php">Liste des tâches</a>
          </li>
          <li>
            <a href="records.php" class="active">Records</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="https://github.com/ponsfrilus/TestPaginationPHP" target="_blank">GitHub repo</a></li>
        </ul>

      </div>
    </div>
  </div>

<?php
  $page=2;
  // $perPage=20;
  $jsonString = file_get_contents("assets/data/records.json");
  $jobject = json_decode ($jsonString);
  $nbEntry = 0;
  foreach ($jobject->releases as $entry) {
    $nbEntry++;
  }
  // echo "nbEntry:";
  // echo $nbEntry;
  $status = $jobject->releases[0]->status;
  $nbPagination = $nbEntry / $perPage;
  $modulo=$nbEntry%$perPage;
  round($nbPagination, 0);
  // echo $nbPagination, $modulo;
  if ($modulo == 0) {
    // echo "coucou";
    // echo $nbPagination;
  }
  else {
    // echo "hey";
    $nbPagination++;
    $nbPagination = (int)$nbPagination;
    // echo $nbPagination;
  }
?>

  <div class="container">
    <div class="page-header" id="banner">
      <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
          <h1>Test PHP - Pagination</h1>
          <p class="lead">Liste des enregistrements</p>
        </div>
        <div class="col-lg-4 col-md-5 col-sm-6">
          <img src="./assets/img/ninjatunesmonkey.jpg" width="250px" />
        </div>

        <div class="btn-group">
          <a  class="btn btn-default">Par page :</a>
          <a href="?page=<?=$page?>&perPage=10" class="btn btn-default<?=($perPage==10)?' active':''?>">10</a>
          <a href="?page=<?=$page?>&perPage=25" class="btn btn-default<?=($perPage==25)?' active':''?>">25</a>
          <a href="?page=<?=$page?>&perPage=50" class="btn btn-default<?=($perPage==50)?' active':''?>">50</a>
          <a href="?page=<?=$page?>&perPage=100" class="btn btn-default<?=($perPage==100)?' active':''?>">100</a>
        </div>

        <div class="col-lg-12">
          <h2 id="tables">Records</h2>
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>N°</th>
                <th>status</th>
                <th>thumb</th>
                <th>format</th>
                <th>title</th>
                <th>catno</th>
                <th>year</th>
                <th>resource_url</th>
                <th>artist</th>
                <th>id</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $keynumber=$page*$perPage-$perPage;
              // echo $keynumber;
              for($line = 1; $line <= $perPage; $line++): ?>
                <tr>
                  <td><?=$keynumber + 1?></td>
                  <td><?=$jobject->releases[$keynumber]->status?></td>
                  <td><?=$jobject->releases[$keynumber]->thumb?></td>
                  <td><?=$jobject->releases[$keynumber]->format?></td>
                  <td><?=$jobject->releases[$keynumber]->title?></td>
                  <td><?=$jobject->releases[$keynumber]->catno?></td>
                  <td><?=$jobject->releases[$keynumber]->year?></td>
                  <td><?=$jobject->releases[$keynumber]->resource_url?></td>
                  <td><?=$jobject->releases[$keynumber]->artist?></td>
                  <td><?=$jobject->releases[$keynumber]->id?></td>
                </tr>
              <?php
              $keynumber++;
              endfor ?>
            </tbody>
          </table>
        </div>


        <?php $current_page = 1 ?>
        <div class="col-lg-12">
          <h2 id="pagination">Pagination</h2>
            <ul class="pagination">
              <li class="disabled"><a href="#">&laquo;</a></li>
              <?php for($page = 1; $page <= 10; $page++): ?>
                  <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                  <li class="page-item <?= ($current_page == $page) ? "active" : "" ?>">
                      <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                  </li>
              <?php endfor ?>
              <li><a href="#">&raquo;</a></li>
            </ul>
            <br />
            <ul class="pagination pagination-lg">
              <li class="disabled"><a href="#">&laquo;</a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>
            <br />
            <ul class="pagination pagination-sm">
              <li class="disabled"><a href="#">&laquo;</a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
      </div>
    </div>

    <footer>
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled">
            <li class="pull-right"><a href="#top">Back to top</a></li>
            <li><a href="https://github.com/ponsfrilus/TestPaginationPHP">View source on GitHub</a> <small>(Pull requests welcome)</small></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>

</html>
