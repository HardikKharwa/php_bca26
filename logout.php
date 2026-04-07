<?php
session_start();
include("database.php");

if(isset($_SESSION)){
    session_destroy();
}
header("Location:login.php");
?>