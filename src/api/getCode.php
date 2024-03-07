<?php
include '../db/config.php';
include './responseClass.php';
include './customerDetails.php';
include './invoiceDetails.php';

$responseObj = new responseClass;

$type = $_POST['type'] ?? '';

if ($type != '') {
    if ($type == 'customer') {
        $listObj = new customer;
        $responseTxt = $listObj->generateCustomerCode($mysqli);
        $responseObj->respond($responseTxt, 200);
    } else {
        $listObj = new invoice;
        $responseTxt = $listObj->generateInvoiceCode($mysqli);
        $responseObj->respond($responseTxt, 200);
    }
}
