<?php
require_once('database.php');
session_start();

if (isset($_POST['action'])) {
    if(base64_decode($_POST['action']) == "btnaAjax"){
        if(base64_decode($_POST['action1']) == "deleteUser"){
            $userId = base64_decode($_POST['user_id']);

            if(!(empty($userId))){
                $checkUserQuery = "select * from users where id = $id";
                $resCheckUser = mysqli_query($conn,$checkUserQuery);
                $cntCheckUser = mysqli_num_rows($resCheckUser);
                if($cntCheckUser > 0){
                    $deleteUserQuery = "delete from users where id = $id";
                    if(mysqli_query($conn,$deleteUserQuery)){
                        return "Success";
                    }
                    else{
                        return "Fail";
                    }
                }
                else{
                    return "NoUserFound";
                }
            }
            else{
                return "NoData";
            }
        }
    }
}
?>