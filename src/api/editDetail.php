<?php
include '../db/config.php';
include './responseClass.php';
include '../api/customerDetails.php';
include '../api/invoiceDetails.php';
$responseObj = new responseClass;

$table_id = $_POST['table_id'];
$type = $_POST['type'];

if ($type == 'customer') {
    $listObj = new customer;
    $responseTxt = $listObj->getCustomer($mysqli,$table_id);
    $responseObj->respond($responseTxt, 200);
} else {
    $listObj = new invoice;
    $responseTxt = $listObj->getInvoice($mysqli,$table_id);
    $responseObj->respond($responseTxt, 200);
}
