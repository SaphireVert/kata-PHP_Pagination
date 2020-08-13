<?php
/* This file is called on every page and contains every utilities needded */

define("DEBUG", true);

session_name('kata-php');
session_start();

function getRecorsPaginationParams() {
  // TODO: si le paramètre $_GET['page'] est défini, alors on redéfinit la session
  //       sinon on laisse la session tranquille....
  $_SESSION['pagination_current_page'] = 1;
}
function paginate($text) {
  echo $text;
}
