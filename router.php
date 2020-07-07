<?php

// On affiche les erreurs éventuelles
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Nous avons besoin du connecteur à la DB
require_once("./utils.php");

// http://localhost:81/index.php?controller=person&action=edit&param=12
// devient
// http://localhost:81/person/edit/12




$controller_list = ['people', 'home'];
if ($_GET['controller'] != '') {
  // var_dump($_GET['controller']);
  $c = $_GET['controller'];
  if (in_array($c, $controller_list)) {
    // On instancie la class du controller
    require(__DIR__ . '/class.' . $c . '.php');
    $class = ucfirst($c);
    $controllerObj = new $class();


    // On appelle le header
    // echo __DIR__. '/views/body.' . $c . '.php';
    // include_once(__DIR__ . '/views/body.' . $c . '.php');
  }

  if (isset($_GET['action'])) {
    $a = $_GET['action'];
    if (method_exists($controllerObj, $a)){
      if (isset($_GET['param'])) {
        $p = $_GET['param'];
        $controllerObj->$a($p);
      } else {
        $controllerObj->$a();
      }
    } else {
      $controllerObj->defaultAction();
    }
  } else {
    $controllerObj->defaultAction();
  }

} else {
  require(__DIR__ . '/class.page.php');
  $controllerObj = new Page();
  $controllerObj->homePage();
}

// include_once(__DIR__. '/views/test.php');






// echo "<pre>";
// echo $_GET['controller']. '<br>';
// echo $_GET['action']. '<br>';
// echo $_GET['param']. '<br>';
// var_dump($_SERVER);
