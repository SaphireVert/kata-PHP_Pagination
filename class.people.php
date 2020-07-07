<?php
require('class.page.php');
require('models/people.php');
class People extends Page {
  function __construct(){
    $this->People = new MPeople();
  }

  function defaultAction() {
    $this->show();
    // echo 'Action not found, please head to <a href="/people/show">people show</a>';
    // $this->displayFooter();
  }

  function show() {
    $this->displayHeader();
    $this->displayTable();
    $this->create();
    $this->displayFooter();
  }

  function create() {
    ?>
    <form id="frm" name="frm" action="/people/add" method="post">
      <input type="text" name="firstname" value="<?= (isset($dataFromDB['firstname'])) ? $dataFromDB['firstname'] : ''; ?>" />
      <input type="text" name="lastname" value="<?= (isset($dataFromDB['lastname'])) ? $dataFromDB['lastname'] : ''; ?>" />
      <input type="email" name="email" value="<?= (isset($dataFromDB['email'])) ? $dataFromDB['email'] : ''; ?>" />
      <input type="text" name="username" value="<?= (isset($dataFromDB['username'])) ? $dataFromDB['username'] : ''; ?>" />
      <?php if(isset($_POST['idPeopleE'])) { ?>
      <input type="hidden" name="idPeopleForm" value="<?= $_POST['idPeopleE'] ?>" />
    <?php } ?>
      <input type="submit" name="submit" value="<?= (isset($_POST['idPeopleE'])) ? "Edit user" : "Add user"; ?>" />
   </form>
   <?php
  }

  function add(){
    // var_dump($_POST;
    if($this->People->insert($_POST)){
      $_SESSION['message'] = "Enregistrement effectué";
      header('Location: /people');
      die();
    }
  }


  function displayTable() {
    echo "<table border=1>\n";
    echo "\t<tr>\n";
    echo "\t\t<th>Firstname</th>\n";
    echo "\t\t<th>Lastname</th>\n";
    echo "\t\t<th>Email</th>\n";
    echo "\t\t<th>Username</th>\n";
    echo "\t\t<th></th>\n";
    echo "\t\t<th></th>\n";
    echo "\t</tr>\n";
    foreach ($this->People->getAllPeople() as $people) {
      ?>
      <tr>
        <td><?= htmlentities($people['firstname']) ?> </td>
        <td><?= $people['lastname'] ?> </td>
        <td> (<a href="mailto:<?= $people['email'] ?>"> <?= $people['email']?></a>)</td>
        <td>@<?=$people['username']?></td>
        <td>
          <form id="frmd<?=$people['id']?>" name="frmd<?=$people['id']?>" action="/people/delete/<?= $people['id']?>" method="post" onsubmit="return checkDelete()">
            <input type="hidden" name="idPeopleD" value="<?= $people['id']?>"/>
            <input type="submit" value="delete"/>
          </form>
      </td>
      <td>
        <form id="frme<?=$people['id']?>" name="frme<?=$people['id']?>" action="index.php" method="post">
          <input type="hidden" name="idPeopleE" value="<?= $people['id']?>"/>
          <input type="submit" value="edit"/>
        </form>
        </td>
      </tr>
      <?php
    }
    echo "</table>";
  }

}
