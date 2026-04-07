<?php
require_once('database.php');
session_start();

if (isset($_POST['action'])) {
    if(base64_decode($_POST['action']) == "btnaAjax"){
        if(base64_decode($_POST['action1']) == "deleteUser"){
            $userId = base64_decode($_POST['user_id']);

            if(!(empty($userId))){
                $checkUserQuery = "select * from users where id = $userId";
                $resCheckUser = mysqli_query($conn,$checkUserQuery);
                $cntCheckUser = mysqli_num_rows($resCheckUser);
                if($cntCheckUser > 0){
                    $deleteUserQuery = "delete from users where id = $userId";
                    if(mysqli_query($conn,$deleteUserQuery)){
                        echo "Success";
                    }
                    else{
                        echo "Fail";
                    }
                }
                else{
                    echo "NoUserFound";
                }
            }
            else{
                echo "NoData";
            }
        }
    }
}
?>