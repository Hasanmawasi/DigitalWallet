<?php 
class User{
  private $name;
  private $email;
  private $password;
  private $is_verify;
  private $is_premuim;

  function  __construct($name, $email, $password)
  {
    $this->name = $name;
    $this->setUserEmail($email);
    $this->password = $password;
    $this->is_verify= false;
    $this->is_premuim= false;

  }

  function setUserName($newName){
    $this->name = $newName;
  }
  function getUserName(){
    return $this->name;
  }

  function setUserEmail($newEmail){
    if(filter_var($newEmail,FILTER_VALIDATE_EMAIL)){
      $this->email = $newEmail;
    }
  }
  function getUserEmail(){
    return $this->email;
  }
  function setUserPassword($newPass){
    $this->password = $newPass;
  }
  function getPassword(){
    return $this->password;
  }

  function setVerify($newVerify){
    if($newVerify == true || $newVerify== false){
        $this->is_verify = $newVerify;
    }
  }
  function getVerify(){
    return $this->is_verify;
  }
  function setPremuim($newPremuim){
    if($newPremuim == true || $newPremuim== false){
        $this->is_premuim = $newPremuim;
    }
  }
  function getPremuim(){
    return $this->is_premuim;
  }
}




?>