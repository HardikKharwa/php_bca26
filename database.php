<?php
    $conn = new mysqli("localhost","root","","bca26");
    if(!$conn){
        echo "Error while connecting database";
        die();
    }
?>