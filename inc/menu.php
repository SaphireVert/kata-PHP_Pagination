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
          <a href="index.php" class="<?= ($_SERVER["PHP_SELF"] == '/index.php') ? 'active' : '' ?>">Accueil</a>
        </li>
        <li>
          <a href="tasks.php" class="<?= ($_SERVER["PHP_SELF"] == '/tasks.php') ? 'active' : '' ?>">Liste des tâches</a>
        </li>
        <li>
          <a href="records.php" class="<?= ($_SERVER["PHP_SELF"] == '/records.php') ? 'active' : '' ?>">Records</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://github.com/ponsfrilus/TestPaginationPHP" target="_blank">GitHub repo</a></li>
      </ul>

    </div>
  </div>
</div>
