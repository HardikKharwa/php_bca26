<?php
function getUserData($conn,$id,$username,$password) {
    $data = array();
    $query = "select * from users ";
    if($id != ""){
        $query .= " where id = $id";
    }
    else if($username != ""){
        $query .= " where username = '$username'";
    }
    else if($password != ""){
        $query .= " where password = '$password'";
    }
    $query .= "";
    $res = mysqli_query($conn,$query);
    $cnt = mysqli_num_rows($res);
    if($cnt > 0){
        while($row = mysqli_fetch_assoc($res)){
            $data[] = $row; 
        }
    }
    return $data;
}
?>