<?php 
class usersFunc{
    private $db;

    function __construct($db)
    {
        $this-> db = $db;
    }

    function createUser(User $user){
        $sql = "INSERT INTO users(user_name ,email, password,is_verify,is_premium) VALUES(?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt -> bind_param("sssii",
                              $user->getUserName(),
                              $user->getUserEmail(),
                              $user->getPassword(),
                              $user->setVerify(false),
                              $user->setPremuim(false));
                              
        if($stmt->execute()) {
            json_encode(["success"=>true , "message"=>"User added successfully"]);
        }else{
            json_encode(["success"=>false , "message"=>$stmt->error]);
        }
    }
}





?>