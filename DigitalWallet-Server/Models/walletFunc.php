<?php 
class walletFunc{
private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function createWallet(wallet $wallet){
        $sql = "INSERT INTO wallets(wallet_name,user_id,balance,currency,daily_limit,created_at) VALUES(?,?,?,?,?,?)";
        $stmt= $this->db->prepare($sql);
        $user_id= $wallet->getUserId();
        $balance= $wallet->getBalance();
        $currency = $wallet->getCurrency();
        $daily_limit = $wallet->getDailyLimit();
        $created_at = $wallet->getCreateAt();
        $walletName = $wallet->getwalletName();
        $stmt->bind_param("siisis",
                         $walletName,
                        $user_id,
                        $balance,
                        $currency,
                        $daily_limit,
                        $created_at );
                        
        if($stmt->execute()){
            echo json_encode(["success"=>true,"message"=>"Wallet created!"]);
            return;
        }else{
            echo json_encode(["success"=>false,"message"=>"Wallet failed to create!"]);

        }
    }

    public function withDraw(wallet $wallet, int $num){
        $sql="update wallets set balance = balance - ? where wallet_id = ?";
        
        if($wallet->getBalance() < $num){
            return false;
        }
        $wallet->setBalance($wallet->getBalance() - $num);
        $stmt = $this->db->prepare($sql);
        $id = $wallet->getWalletId();
        $stmt->bind_param("ii",$num,$id);
        if($stmt->execute()){
            $sql2 = "INSERT INTO withdraws(amount, wallet_id,withdraw_date) VALUES(?,?,CURRENT_DATE())";
            $stmt = $this->db->prepare($sql2);
            $stmt->bind_param("ii",$num,$id);
            if($stmt->execute()){
                return true;
            }
        }
    }
    public function Deposit(wallet $wallet,int $num){
        $sql="update wallets set balance = balance + ? where wallet_id = ?";
        if($num < 0){
            return false;
        }
        $wallet->setBalance($wallet->getBalance() + $num);
        $stmt = $this->db->prepare($sql);
        $id = $wallet->getWalletId();
        $stmt->bind_param("ii",$num,$id);
        if($stmt->execute()){
            $sql2 = "INSERT INTO deposits(amount, wallet_id,deposit_date) VALUES(?,?,CURRENT_DATE())";
            $stmt = $this->db->prepare($sql2);
            $stmt->bind_param("ii",$num,$id);
            if($stmt->execute()){
                return true;
            }
        }
    }

    public function getWallet(int $id){
        $sql = "SELECT * FROM wallets WHERE wallet_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i",$id);
        if($stmt->execute()){
            $result = $stmt -> get_result();
            if($result-> num_rows >0){
               $data= $result->fetch_assoc();
                $wallet = new wallet($data['wallet_name'],$data["user_id"],$data["balance"],$data["currency"],$data["daily_limit"]);
                $wallet->setWalletId($data['wallet_id']);
                echo json_encode(["walletData"=>$wallet->getWalletInfo()]);
                return $wallet;
            }
        }
    }

    public function getWallets(int $userID){
        $sql = "SELECT * FROM wallets WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i",$userID);
        if($stmt->execute()){
            $result = $stmt -> get_result();
            if($result-> num_rows >0){
               $data= [];
            while($row= $result->fetch_assoc()){
                $wallet = new wallet($row['wallet_name'],$row["user_id"],$row['balance'],$row["currency"],$row["daily_limit"]);
                $wallet->setWalletId($row['wallet_id']);
                array_push($data , $wallet->getWalletInfo());
            }
            return json_encode(["walets"=>$data]) ;
            }
        }

    }
    
} 


?>