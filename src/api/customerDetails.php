<?php

class customer
{
    function getCustomerList($mysqli)
    {
        $qry = $mysqli->query("SELECT * FROM `customer` WHERE 1");
        $data = array();
        while ($row = $qry->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    function getCustomer($mysqli, $id)
    {
        $qry = $mysqli->query("SELECT * FROM `customer` WHERE id = '$id'");
        $row = $qry->fetch_assoc();
        return $row;
    }

    function submitCustomer($mysqli)
    {
        $table_id = $_POST['cus_table_id'];
        $cus_id = $_POST['customer_id'];
        $name = $_POST['customer_name'];
        $phone = $_POST['customer_phone']!=''?$_POST['customer_phone']:NULL;
        $email = $_POST['customer_email']!=''?$_POST['customer_email']:NULL;
        $address = $_POST['customer_address']!=''?$_POST['customer_address']:NULL;

        if ($table_id == '') {
            //insert new customer
            $mysqli->query("INSERT INTO `customer`(`cus_id`, `name`, `phone`, `email`, `address`) VALUES ('" . strip_tags($cus_id) . "','" . strip_tags($name) . "','" . strip_tags($phone) . "','" . strip_tags($email) . "','" . strip_tags($address) . "')");
        } else {
            //update customer table
            $mysqli->query("UPDATE `customer` SET `cus_id`='" . strip_tags($cus_id) . "',`name`='" . strip_tags($name) . "',`phone`='" . strip_tags($phone) . "',`email`='" . strip_tags($email) . "',`address`='" . strip_tags($address) . "' WHERE id = '$table_id'");
        }
        if ($mysqli) {
            return 'success';
        } else {
            return 'Error';
        }
    }

    function generateCustomerCode($mysqli)
    {
        $prefix = "CUS";
        $qry = $mysqli->query("SELECT cus_id FROM customer WHERE cus_id != '' ");
        if ($qry->num_rows > 0) {
            //if codes are available then get the last code and add 1 to it
            $codeAvailable = $mysqli->query("SELECT cus_id FROM customer WHERE cus_id != '' ORDER BY `id` DESC LIMIT 1");
            while ($row = $codeAvailable->fetch_assoc()) {
                $exist_code = $row["cus_id"];
            }
            //separate code and number
            $num = ltrim(strstr($exist_code, '-'), '-');
            $num = $num + 1;
            $cus_code = $prefix . "-" . "$num";
        } else {
            $initialCode = $prefix . "-101";
            $cus_code = $initialCode;
        }
        return $cus_code;
    }
}
