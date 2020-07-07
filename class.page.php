<?php
/**
 *
 */
class Page {
  function __construct(){}
  function displayHeader(){
    // On appelle le header
    include_once(__DIR__. '/views/header.php');
    $this->flashMessage();
  }
  function displayFooter(){
    // On appelle le footer
    include_once(__DIR__ . '/views/footer.php');
  }
  function defaultAction(){
    echo 'defaultAction';
  }
  function homePage(){
    ?>
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
            <h1>Homepage</h1>
      </body>
    </html>
<?php

  }

  function flashMessage() {
    $message = $_SESSION['message'] ?? null;
    if ($message) {
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    }
  }

}
 ?>
