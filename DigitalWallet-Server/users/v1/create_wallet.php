 <?php 
session_start();
include("../../Utils/header.php"); 
require("../../connection/connection.php");
require("../../Models/wallets.php");
require("../../Models/walletFunc.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$data = json_decode(file_get_contents("php://input"),true);
if(empty($data['walletname']) || empty($data["balance"]) || empty($data["currency"])){
    echo json_encode(["success"=>false , "message"=>"Fill all the blank!!!!"]);
    return;
}

 try {

    $userID =$data['id'];
    $balance = $data["balance"];
    $currency= $data["currency"];
    $walletname= $data["walletname"];
    $daily_limit = 50;
    $wallet = new wallet($walletname,$userID,$balance,$currency,$daily_limit);
    $walletFunc = new walletFunc($mysqli);
    $walletFunc->createWallet($wallet);
    if( $walletFunc->createWallet($wallet)){
        echo json_encode(["success"=>true,"message"=>"wallet created"]);
    }
 
 } catch (Exception $th) {
    echo json_encode(["success"=>false,"message"=>"wallet failed to create!"]);
    echo $th;
 }
}

?>