<?php
    $conn = new mysqli("localhost","root","admin","bca26");
    if(!$conn){
        echo "Error while connecting database";
        die();
    }
?>