<!DOCTYPE html>
<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
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

<?php $page=5 ?>

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
          <a href="#" class="btn btn-default">Par page :</a>
          <div class="btn-group">
            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#?page=<?=$page?>&perPage=10" value="10">10</a></li>
              <li><a href="#?page=<?=$page?>&perPage=25">25</a></li>
              <li><a href="#?page=<?=$page?>&perPage=50">50</a></li>
              <li><a href="#?page=<?=$page?>&perPage=100">100</a></li>
              <li><a href="#?page=<?=$page?>&perPage=10000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000">1'000'000'000 MOUAHAHAHAH !!!</a></li>
             </ul>
          </div>
        </div>

        <div class="col-lg-12">
          <h2 id="tables">Tables</h2>
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
              <?php for($page = 1; $page <= 10; $page++): ?>
                <tr>
                  <td><?=$page?></td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                  <td>Column content</td>
                </tr>
              <?php endfor ?>
            </tbody>
          </table>
        </div>

        <?php for($page = 1; $page <= 10; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= (5 == $page) ? "active" : "" ?>">
                <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>

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
