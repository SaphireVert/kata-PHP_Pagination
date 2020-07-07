<?php

class MPeople {
  private $db;
  function __construct(){
    require_once("./db.php");
    $this->db = $connexion;
  }


  function getAllPeople() {
    return $this->db->query("SELECT * FROM people")->fetchAll();
  }


  function insert($data) {
    $insert_people = "INSERT INTO people (firstname, lastname, email, username) VALUES (:firstname, :lastname, :email, :username);";
    $sth = $this->db->prepare($insert_people);
    $sth->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
    $sth->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $sth->bindParam(':email', $email, PDO::PARAM_STR);
    $sth->bindParam(':username', $data['username'], PDO::PARAM_STR);
    return $sth->execute();

  }
  function delete($id) {
    $delete_people = "DELETE FROM `people` WHERE id = :id;";
    $sth = $this->db->prepare($delete_people);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    return $sth->execute();
  }

  function update($data) {
    $update_people = "UPDATE `people`
                      SET firstname = :firstname,
                      lastname = :lastname,
                      email = :email,
                      username = :username
                      WHERE id = :idPeopleForm;";
    $sth = $this->db->prepare($update_people);
    $sth->bindParam(':idPeopleForm', $data['idPeopleForm'], PDO::PARAM_INT);
    $sth->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
    $sth->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
    $sth->bindParam(':email', filter_var($data['email'], FILTER_SANITIZE_EMAIL), PDO::PARAM_STR);
    $sth->bindParam(':username', $data['username'], PDO::PARAM_STR);
    return $sth->execute();
  }
  function getById($id){
    $edit_people = "SELECT * FROM people WHERE id = :id;";
    $sth = $this->db->prepare($edit_people);
    $sth->bindParam(':id', $id, PDO::PARAM_INT);
    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);
    // return $sth->fetch();
  }
}
