<?php 
include("../../Utils/header.php");
include("../../connection/connection.php");

$data=json_decode(file_get_contents("php://input"),true);

if(isset($data['wallet_id'])){

    $sql = "SELECT 
    DATE_FORMAT(withdraw_date, '%Y-%m') AS month,  
    SUM(amount) AS total_withdrawn               
FROM withdraws
WHERE wallet_id = ?  
GROUP BY month
ORDER BY month;
";
    $stmt =$mysqli->prepare($sql);
    $stmt->bind_param('i',$data["wallet_id"]);
    if($stmt->execute()){
        $result  = $stmt->get_result();
        if( $result -> num_rows> 0){
            $month = [];
            $amount = [];
            while ($row = $result->fetch_assoc()) {
                $month[] = $row['month'];
                $amount[] =(int) $row["total_withdrawn"];
            }
            echo json_encode(["month"=>$month,"amount"=>$amount]);
            return;
        }
    }
}


?>