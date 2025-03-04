<?php 
class usersFunc{
    private $db;

    function __construct($db)
    {
        $this-> db = $db;
    }
    // insert the  new user object to the data base
    function createUser(User $user){
        $sql = "INSERT INTO users(user_name ,user_email, password,is_verify,is_premium) VALUES(?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $username  = $user->getUserName();
        $user_email =  $user->getUserEmail();
        $password = $user->getPassword();
        $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
        $verify =false;
        $premium = false;
        $stmt -> bind_param("sssii",
                              $username ,
                             $user_email,
                             $hashedPassword,
                             $verify,
                             $premium
                            );
        
        
        if($stmt->execute()) {
           echo json_encode(["success"=>true , "message"=>"User added successfully"]);
        }else{
            echo json_encode(["success"=>false , "message"=>$stmt->error]);
        }
    }
    
    public function createCard($user_id){
        $sql = "INSERT INTO cards_info(card_number ,postal_code, expire_date,user_id) VALUES(?,?,?,?)";
        $stmt = $this->db->prepare($sql);

            $card_number = round(microtime(true) * 1000);
                $postal_code=0000;
                $expire_date = date('Y-m-d', strtotime('+5 years'));

                $stmt -> bind_param("iisi",
                $card_number,
                $postal_code,
                $expire_date,
                $user_id
              );
              if($stmt->execute()) {
                // echo json_encode(["success"=>true , "message"=>"card added successfully"]);
             }else{
                 echo json_encode(["success"=>false , "message"=>$stmt->error]);
             }               
              
    }
    // search for user return user if found and used in sign up  and login to find if the email already in database
    public function searchUserByEmail(User $user){
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $this->db->prepare($sql);
        $email = $user->getUserEmail();
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result-> num_rows >0){
                return $result->fetch_assoc();
            }
            return false;
        }
    }

    

}





?>