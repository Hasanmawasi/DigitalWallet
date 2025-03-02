<?php 
class User{
  private $name;
  private $email;
  private $password;
  private $is_verify;
  private $is_premuim;

  public function  __construct($name, $email, $password)
  {
    $this->name = $name;
    $this->setUserEmail($email);
    $this->password = $password;
    $this->is_verify= false;
    $this->is_premuim= false;

  }

  public function setUserName($newName){
    $this->name = $newName;
  }
  function getUserName(){
    return $this->name;
  }

  public function setUserEmail($newEmail){
    if(filter_var($newEmail,FILTER_VALIDATE_EMAIL)){
      $this->email = $newEmail;
    }
  }
  public function getUserEmail(){
    return $this->email;
  }
  public function setUserPassword($newPass){
    $this->password = $newPass;
  }
  public function getPassword(){
    return $this->password;
  }

  public function setVerify($newVerify){
    if($newVerify == true || $newVerify== false){
        $this->is_verify = $newVerify;
    }
  }
  public function getVerify(){
    return $this->is_verify;
  }
  public function setPremuim($newPremuim){
    if($newPremuim == true || $newPremuim== false){
        $this->is_premuim = $newPremuim;
    }
  }
  public function getPremuim(){
    return $this->is_premuim;
  }
}




?>