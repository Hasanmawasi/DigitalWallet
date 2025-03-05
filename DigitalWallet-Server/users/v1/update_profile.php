<?php
include("../../connection/connection.php");
include("../../Utils/header.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'] ;
    $userPhone = $_POST['userPhone'] ;
    $userCardID = $_POST['userCardID'] ;
    $userAddress = $_POST['userAddress'];
    $userID=$_POST['userID'];
    $uploadDir = "image/profiles"; 
    $photoPath = "";
    
    
    if (isset($_FILES['userPhoto'])) {
        $photoName = basename($_FILES['userPhoto']['name']);
        $photoPath = $uploadDir . time() . "_" . $photoName;
        if (move_uploaded_file($_FILES['userPhoto']['tmp_name'], $photoPath)) {
            $photoPath = $photoPath;
        } else {
            echo json_encode(["status" => "error", "message" => "Photo upload failed"]);
            exit;
        }
    }
        
    $stmt = $mysqli->prepare("UPDATE users 
                             SET user_name = ?, user_email = ?, profile_url = ? 
                             WHERE user_id = ?;");
    $stmt->bind_param("sssi", $userName, $userEmail, $photoPath, $userID);
    $stmt1 = $mysqli->prepare("INSERT INTO users_verification(user_id, address,id_card_number,phone_number) VALUES (?, ?, ?,?)");
    $stmt1-> bind_param("isii", $userID, $userAddress, $userCardID, $userPhone);
    if ($stmt->execute() && $stmt1->execute()) {
        echo json_encode(["success" => true, "message" => "User updated successfully!!!"]);
    } else {
        echo json_encode(["success" => false, "message" => "database error!!"]);
    }
    
  
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
