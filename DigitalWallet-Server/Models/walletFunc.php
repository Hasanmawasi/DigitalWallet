<?php 
class walletFunc{
private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    function createWallet(wallet $wallet){
        $sql = "INSERT INTO wallets(user_id,balance,currency,daily_limit,created_at)";
        $stmt= $this->db->prepare($sql);
        $user_id= $wallet->getUserId();
        $balance= $wallet->getBalance();
        $currency = $wallet->getCurrency();
        $daily_limit = $wallet->getDailyLimit();
        $created_at = $wallet->getCreateAt();
        $stmt->bind_param("iisis",
                        $user_id,
                        $balance,
                        $currency,
                        $daily_limit,
                        $created_at );
                        
        if($stmt->excute()){
            echo json_encode(["success"=>true,"message"=>"Wallet created!"]);
            return;
        }else{
            echo json_encode(["success"=>false,"message"=>"Wallet failed to create!"]);

        }
    }

}


?>