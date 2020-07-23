<?php
  $pageTitle = "Records";
  require "inc/header.php";
  require "inc/menu.php";
  $current_page = $_GET['page'] ? $_GET['page'] : 1;
  $perPage = $_GET['perPage'] ? $_GET['perPage'] : 10;
  $jsonString = file_get_contents("assets/data/records.json");
  $jobject = json_decode ($jsonString);
  $nbEntry = 0;
  foreach ($jobject->releases as $entry) {
    $nbEntry++;
  }
  $status = $jobject->releases[0]->status;
  $nbPagination = $nbEntry / $perPage;
  $modulo=$nbEntry%$perPage;
  if ($modulo != 0) {
    $nbPagination++;
    $nbPagination = (int)$nbPagination;
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
          <a href="?page=<?=$current_page?>&perPage=10" class="btn btn-default<?=($perPage==10)?' active':''?>">10</a>
          <a href="?page=<?=$current_page?>&perPage=25" class="btn btn-default<?=($perPage==25)?' active':''?>">25</a>
          <a href="?page=<?=$current_page?>&perPage=50" class="btn btn-default<?=($perPage==50)?' active':''?>">50</a>
          <a href="?page=<?=$current_page?>&perPage=100" class="btn btn-default<?=($perPage==100)?' active':''?>">100</a>
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
              $keynumber=$current_page*$perPage-$perPage;
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

<!-- if $current_page > 5
  nbpage = currentpage -4 -->

        <div class="col-lg-12">
          <h2 id="pagination">Pagination</h2>
            <ul class="pagination">
              <li><a href="?page=1">&laquo;</a></li>
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
                for($nbPage = 1; $nbPage  <= 9; $nbPage++): ?>
                    <li class="page-item <?= ($current_page == $tmpNoPage) ? "active disabled" : "" ?>">
                        <a href="<?=($current_page != $tmpNoPage) ? "?page=$tmpNoPage&perPage=$perPage" : ""?>" class="page-link"><?= $tmpNoPage ?></a>
                    </li>
              <?php
                $tmpNoPage++;
                endfor ?>
              <li><a href="?page=<?= (int)$nbPagination ?>">&raquo;</a></li>
            </ul>
        </div>
      </div>
    </div>
<?php require "inc/footer.php"; ?>
