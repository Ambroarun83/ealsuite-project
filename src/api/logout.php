<?php
session_start();
include './responseClass.php';
$responseObj = new responseClass();

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);

$responseTxt = 'Success';
$responseObj->respond($responseTxt, 200);//success
