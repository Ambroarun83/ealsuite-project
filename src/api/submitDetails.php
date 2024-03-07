<?php
include '../db/config.php';
include './responseClass.php';
include '../api/customerDetails.php';
include '../api/invoiceDetails.php';
$responseObj = new responseClass;

$type = $_POST['type'];

if ($type == 'customer') {
    $listObj = new customer;
    $responseTxt = $listObj->submitCustomer($mysqli);
    $responseObj->respond($responseTxt, 200);
} else {
    $listObj = new invoice;
    $responseTxt = $listObj->submitInvoice($mysqli);
    $responseObj->respond($responseTxt, 200);
}
