<?php

class invoice{
    function getInvoiceList($mysqli){
        $qry = $mysqli->query("SELECT * FROM `invoice` WHERE 1");
        $data = array();
        while($row = $qry->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
}

