<?php
class responseClass{
    
    function respond($data, $status) {
        header('Content-Type: application/json');
        if($status == 200){
            http_response_code($status);
        }
        echo json_encode($data);
    }
}