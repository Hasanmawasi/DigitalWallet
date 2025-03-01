<?php 
class usersFunc{
    private $db;

    function __construct($db)
    {
        $this-> db = $db;
    }

    function createUser(User $user){
        $sql = "INSERT INTO users(user_name ,user_email, password,is_verify,is_premium) VALUES(?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $username  = $user->getUserName();
        $user_email =  $user->getUserEmail();
        $password = $user->getPassword();
        $verify =false;
        $premium = false;
        $stmt -> bind_param("sssii",
                              $username ,
                             $user_email,
                             $password,
                             $verify,
                             $premium
                            );

        if($stmt->execute()) {
           echo json_encode(["success"=>true , "message"=>"User added successfully"]);
        }else{
            return json_encode(["success"=>false , "message"=>"$stmt->error"]);
        }
    }

    function searchUserByEmail(User $user){
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $stmt = $this->db->prepare($sql);
        $email = $user->getUserEmail();
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result-> num_rows >0){
                return true;
            }
            return false;
        }
    }
}





?>