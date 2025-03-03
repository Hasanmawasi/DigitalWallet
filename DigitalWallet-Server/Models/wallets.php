<?php
class wallet{

    private $walletid;
    private $walletname;
    private $user_id;
    private $balance;
    private $currency;
    private $dailylimit;
    private $createdAt;

    function __construct($walletname,$user_id, $balance,$currency,$dailylimit)
    {
        $this->walletname = $walletname;
        $this->user_id = $user_id;
        $this->setBalance($balance) ;
        $this->currency = $currency;
        $this->dailylimit = $dailylimit;
        $this->createdAt = date("d-m-Y");
    }
    
    public function getWalletId() {
        return $this->walletid;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function getDailyLimit() {
        return $this->dailylimit;
    }
    public function getCreateAt(){
        return $this->createdAt;

    }
    public function getwalletName(){
        return $this->walletname;
    }

    public function setWalletId($walletid) {
        $this->walletid = $walletid;
    }
    public function setWalletName($name){
        $this->walletname = $name;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setBalance($balance) {
        if($balance >= 0){ 
        $this->balance = $balance;
        }
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function setDailyLimit($dailylimit) {
        $this->dailylimit = $dailylimit;
    }

    public function getWalletInfo(){
        return [
            "wallet_id"=>$this->getWalletId(),
            "user_id"=>$this->getUserId(),
            "balance"=>$this->getBalance(),
            "currency"=>$this->getCurrency(),
            "created_at"=>$this->getCreateAt(),
            "daily_limit"=>$this->getDailyLimit(),
            "wallet_name"=>$this->getwalletName()
        ];
    }

}

?>