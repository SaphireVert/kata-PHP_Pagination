<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_id() == '') {
  session_start();
}
require_once("./db.php");
require_once("./class.people.php");
require_once("./utils.php");
$ppl = new People($connexion);

// if(isset($_POST['idPeopleU'])){
//   $ppl->update($_POST['idPeopleU']);
//   $_SESSION['message'] = "Modification effectuée";
//   header('Location: index.php');
//   die();
// }
if(isset($_POST['idPeopleE'])){
  $dataFromDB = $ppl->getById($_POST['idPeopleE']);
  // $ppl->update($_POST['idPeopleE']);
  // $_SESSION['message'] = "Modification effectuée";
  // header('Location: index.php');
  // die();
}

if(isset($_POST['idPeopleD'])){
  $ppl->delete($_POST['idPeopleD']);
  $_SESSION['message'] = "Suppression effectuée";
  header('Location: index.php');
  die();
}
// var_dump(isset($_POST['editOrAdd']));
var_dump(isset($_POST['submit']));
if(isset($_POST['submit'])){
  if($_POST['submit'] == 'Add user'){
    if (isset($_POST['firstname']) && !empty($_POST['firstname'])
    && isset($_POST['lastname']) && !empty($_POST['lastname'])) {
      if ($ppl->insert($_POST)) {
        $_SESSION['message'] = "Enregistrement effectué";
        header('Location:' . $_SERVER['PHP_SELF']);
        die();
      } else {
          echo "Erreur lors de l'enregistrement";
      }
    }
  } else if ($_POST['submit'] == 'Edit user'){
      if ($ppl->update($_POST)){
        $_SESSION['message'] = "Modification effectuée";
        header('Location:' . $_SERVER['PHP_SELF']);
        die();
      } else {
          echo "Erreur lors de l'enregistrement";
      }
  }
}
else {
  echo 'Rien';
}

?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>testMVC</title>
    <link rel="stylesheet" href="monstyle.css" />
    <script type="text/javascript" src="monscript.js"></script>
  </head>
  <body>
    <?php flashMessage(); ?>
    <ul>
      <?php
        // R(ead) du CRUD
        $ppl->displayTable();
      ?>
    </ul>



   <form id="frm" name="frm" action="index.php" method="post">
     <input type="text" name="firstname" value="<?= (isset($dataFromDB['firstname'])) ? $dataFromDB['firstname'] : ''; ?>" />
     <input type="text" name="lastname" value="<?= (isset($dataFromDB['lastname'])) ? $dataFromDB['lastname'] : ''; ?>" />
     <input type="email" name="email" value="<?= (isset($dataFromDB['email'])) ? $dataFromDB['email'] : ''; ?>" />
     <input type="text" name="username" value="<?= (isset($dataFromDB['username'])) ? $dataFromDB['username'] : ''; ?>" />
     <?php if(isset($_POST['idPeopleE'])) { ?>
     <input type="hidden" name="idPeopleForm" value="<?= $_POST['idPeopleE'] ?>" />
   <?php } ?>
     <input type="submit" name="submit" value="<?= (isset($_POST['idPeopleE'])) ? "Edit user" : "Add user"; ?>" />
  </form>
  <!-- <button type='button' id='btn_delete' name='btn_delete'>delete</button> -->
  <!-- <form id="frmd" name "frmd[]" action="index.php" method="post"><p><input type="hidden" name="idPeople" value="test" /><input type="submit" value="delete" /></p></form> -->


  </body>
</html>
