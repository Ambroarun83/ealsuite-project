<?php

class invoice
{
    function getInvoiceList($mysqli)
    {
        $qry = $mysqli->query("SELECT * FROM `invoice` WHERE 1");
        $data = array();
        $i = 0;
        while ($row = $qry->fetch_assoc()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['inv_id'] = $row['inv_id'];

            $cus_table_id = $row['cus_table_id'];
            $qry2 = $mysqli->query("SELECT `name` FROM `customer` WHERE id = '$cus_table_id'");
            $cus_name = $qry2->fetch_assoc()['name'];
            $data[$i]['cus_name'] = $cus_name;

            //if date is not given then just pass empty
            if ($row['date'] != '0000-00-00') {
                $data[$i]['date'] = date('d-m-Y', strtotime($row['date']));
            } else {
                $data[$i]['date'] = '';
            }
            $data[$i]['amount'] = $row['amount'];

            $status_arr = ['Unpaid', 'Paid', 'Cancelled'];
            $data[$i]['status'] = $status_arr[$row['status']] ?? '';
            $i++;
        }
        return $data;
    }
    function getInvoice($mysqli, $id)
    {
        $qry = $mysqli->query("SELECT * FROM `invoice` WHERE id = '$id'");
        $row = $qry->fetch_assoc();
        return $row;
    }
    function submitInvoice($mysqli)
    {
        $table_id = $_POST['inv_table_id'];
        $inv_id = $_POST['inv_id'];
        $cus_table_id = $_POST['customer'];
        $date = $_POST['inv_date'];
        $amount = ($_POST['inv_amt'] != '') ? $_POST['inv_amt'] : null;
        $status = $_POST['inv_status'];

        if ($table_id == '') {
            //insert new invoice
            $mysqli->query("INSERT INTO `invoice` (`inv_id`, `cus_table_id`, `date`, `amount`, `status`) VALUES ('" . strip_tags($inv_id) . "', '" . strip_tags($cus_table_id) . "', '" . strip_tags($date) . "', '" . strip_tags($amount) . "', '" . strip_tags($status) . "')");
        } else {
            //update invoice table
            $mysqli->query("UPDATE `invoice` SET `inv_id` = '" . strip_tags($inv_id) . "', `cus_table_id` = '" . strip_tags($cus_table_id) . "', `date` = '" . strip_tags($date) . "', `amount` = '" . strip_tags($amount) . "', `status` = '" . strip_tags($status) . "' WHERE id = '$table_id'");
        }
        if ($mysqli) {
            return 'success';
        } else {
            return 'Error';
        }
    }
    function generateInvoiceCode($mysqli)
    {
        $prefix = "INV";
        $qry = $mysqli->query("SELECT inv_id FROM invoice WHERE inv_id != '' ");
        if ($qry->num_rows > 0) {
            //if codes are available then get the last code and add 1 to it
            $codeAvailable = $mysqli->query("SELECT inv_id FROM invoice WHERE inv_id != '' ORDER BY `id` DESC LIMIT 1");
            while ($row = $codeAvailable->fetch_assoc()) {
                $exist_code = $row["inv_id"];
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
