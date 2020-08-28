<?php
  session_name('kata-php');
  session_start();

  if(!$_SESSION['default']) {
    $_SESSION['default'] = "initialized";
    $_SESSION['page'] = 1;
    $_SESSION['perPage'] = 10;
  }

  function getJson() {
    $jsonString = file_get_contents("assets/data/records.json");
    global $dataObj;
    $dataObj = json_decode($jsonString);
    // var_dump($dataObj);
  }
?>
