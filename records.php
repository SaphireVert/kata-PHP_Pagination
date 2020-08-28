<?php
require('utils.php');
// getRecorsPaginationParams();
getJson();
// echo $_SESSION['pagination_current_page'];
$current_page = $_GET['page'] ? $_GET['page'] : $_SESSION['page'];
$perPage = $_GET['perPage'] ? $_GET['perPage'] : $_SESSION['perPage'];

$_SESSION['page'] = $current_page;
$_SESSION['perPage'] = $perPage;

$nbEntries = count((array)$dataObj->releases);
$nbPagination = ceil($nbEntries / $perPage);

// var_dump($dataObj->releases);
$maxEntry = 0;
$valuesMaxEntry;
foreach ($dataObj->releases as $key => $value) {
  // Thanks to https://stackoverflow.com/questions/1314745/php-count-a-stdclass-object
  if (sizeof((array)$value) > $maxEntry){
    $maxEntry = sizeof((array)$value);
    $valuesMaxEntry = $value;
  }
}
// var_dump($valuesMaxEntry);
?>
<!DOCTYPE html>
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
          <a href="?page=<?=$current_page?>&perPage=10" class="btn btn-default<?=($perPage==10)?' active':''?>">10</a>
          <a href="?page=<?=$current_page?>&perPage=25" class="btn btn-default<?=($perPage==25)?' active':''?>">25</a>
          <a href="?page=<?=$current_page?>&perPage=50" class="btn btn-default<?=($perPage==50)?' active':''?>">50</a>
          <a href="?page=<?=$current_page?>&perPage=100" class="btn btn-default<?=($perPage==100)?' active':''?>">100</a>
        </div>

        <div class="col-lg-12">
          <h2 id="tables">Tables</h2>
          <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <?php
                foreach ($valuesMaxEntry as $key => $value) {
                ?>
                <th><?=$key?></th>
                <?php
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                  $tmpEntry = $current_page * $perPage - $perPage;
                  for ($i=0; $i < $perPage ; $i++) {
                    if($dataObj->releases[$i + $tmpEntry]){
                      ?><td><?=$i + $tmpEntry + 1?></td><?

                      foreach ((array)$dataObj->releases[$i + $tmpEntry] as $key => $value) {
                        ?>
                        <td><?=$value?></td>
                        <?php
                      }
                      ?>
                    </tr>

                    <?php
                    }
                  }
                ?>

            </tbody>
          </table>
        </div>

<div class="col-lg-12">
  <h2 id="pagination">Pagination</h2>
    <ul class="pagination">
      <li class="page-item <?= ($current_page == 1) ? "active disabled" : "" ?>"><a href="?page=1">&laquo;</a></li>
      <li class="page-item <?= ($current_page == 1) ? "active disabled" : "" ?>"><a href="?page=<?php echo ($current_page == 1) ? $current_page : $current_page - 1;?>">&lsaquo;</a></li>
      <?php
        if ($current_page <= 5) {
          $tmpNoPage = 1;
        }
        elseif ($current_page >= (int)$nbPagination - 4) {
          $tmpNoPage = (int)$nbPagination - 8;
        }
        else {
          $tmpNoPage = $current_page - 4;
        }
        for($nbPage = 1; $nbPage <= 9 ; $nbPage++):
        ?>
            <li class="page-item <?= ($current_page == $tmpNoPage) ? "active disabled" : "" ?>">
                <a href="<?=($current_page != $tmpNoPage) ? "?page=$tmpNoPage&perPage=$perPage" : ""?>" class="page-link"><?= $tmpNoPage ?></a>
            </li>
      <?php
        $tmpNoPage++;
        endfor ?>
        <li class="page-item <?= ($current_page == $nbPagination) ? "active disabled" : "" ?>"><a href="?page=<?php echo ($current_page == $nbPagination) ? $current_page : $current_page + 1;?>">&rsaquo;</a></li>
      <li class="page-item <?= ($current_page == $nbPagination) ? "active disabled" : "" ?>"><a href="?page=<?= (int)$nbPagination ?>">&raquo;</a></li>
    </ul>
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
