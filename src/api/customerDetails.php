<?php

class customer{
    function getCustomerList($mysqli){
        $qry = $mysqli->query("SELECT * FROM `customer` WHERE 1");
        $data = array();
        while($row = $qry->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
}

