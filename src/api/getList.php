<?php
include '../db/config.php';
include './responseClass.php';
include './customerDetails.php';
include './invoiceDetails.php';

$responseObj = new responseClass;

$list_type = $_POST['list_type'] ?? '';

if ($list_type != '') {
    if ($list_type == 'customer_list') {
        $listObj = new customer;
        $responseTxt = $listObj->getCustomerList($mysqli);
        $responseObj->respond($responseTxt, 200);
    } else {
        $listObj = new invoice;
        $responseTxt = $listObj->getInvoiceList($mysqli);
        $responseObj->respond($responseTxt, 200);
    }
}
