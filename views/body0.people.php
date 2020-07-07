<?php flashMessage(); ?>
<?php
  // R(ead) du CRUD
  $ppl->displayTable();
?>



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
