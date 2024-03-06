<?php
session_start();
include '../db/config.php';
include './responseClass.php';

$responseObj = new responseClass();

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM user WHERE username = '".strip_tags($username)."' AND password = '".strip_tags($password)."' ";
$result = $mysqli->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['username'];
    
    $responseTxt = 'Success';
    $responseObj->respond($responseTxt,200);//success
}else{
    $responseTxt = 'Error';
    $responseObj->respond($responseTxt, 400);//bad request
}
