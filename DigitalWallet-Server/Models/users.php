<?php 
class User{
  private $name;
  private $email;
  private $password;
  private $is_verify;
  private $is_premuim;

  function  __construct($name, $email, $password, $is_verify, $is_premuim)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->is_verify= $is_verify;
    $this->is_premuim = $is_premuim;

  }

  function setUserName($newName){
    $this->name = $newName;
  }
  function getUserName(){
    return $this->name;
  }

  function setUserEmail($newEmail){
    $this->email = $newEmail;
  }
  function getUserEmail(){
    return $this->email;
  }
  function setUserPassword($newPass){
    $this->password = $newPass;
  }
  


}




?>