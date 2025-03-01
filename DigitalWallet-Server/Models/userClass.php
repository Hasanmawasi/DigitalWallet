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
    $this->setVerify($is_verify);
    $this->setPremuim($is_premuim);

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