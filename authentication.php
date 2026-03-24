<?php
require_once('database.php');
session_start();
print_r($_POST);
if (isset($_POST['btnsubmit'])) {

    /*  LOGIN  */
    if ($_POST['btnsubmit'] == "Login") {

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            echo "All fields are required";
            $_SESSION['error'] = "1";
            $_SESSION['message'] = "All fields are required";
            header("Location:login.php");
        }
        else if (strlen($password) < 8) {
            $_SESSION['error'] = "1";
            $_SESSION['message'] = "Password must be at least 8 characters";
            header("Location:login.php");
            echo "Password must be at least 8 characters";
        }
        else if (strlen($password) > 8) {
            $query = "select id,username,password from users where username = '$username'";
            //mysqli_query -> It executes the query from the db and stores the data in obj format
            $res = mysqli_query($conn,$query);
            // mysqli_num_rows -> IT fetches the count of resultset that is fetched from the query
            $cnt = mysqli_num_rows($res);
            if($cnt > 0){
                //mysqli_fetch_assoc -> Converts data from object format to Array format
                $row = mysqli_fetch_assoc($res);
                if($row['password'] == md5($password)){
                        $_SESSION['username'] = $username;
                        $_SESSION['isloggedIn'] = "1";
                        header("Location: dashboard.php");
                        echo "Login successful";
                }
                else{
                    $_SESSION['error'] = "1";
                    $_SESSION['message'] = "Login Failed, Try Again!";
                    header("Location:login.php");
                }
            }
            else{
                $_SESSION['error'] = "1";
                $_SESSION['message'] = "User not Found, Kindly Register";
                header("Location:login.php");
            }
            
        }
        else {
            $_SESSION['error'] = "1";
            $_SESSION['message'] = "Some error occured, Try Again!";
            header("Location:login.php");
            echo "Login failed";
        }
    }

    /* REGISTER */
    else if ($_POST['btnsubmit'] == "Register") {

        $FullName = $_POST['FullName'] ?? '';
        $username = $_POST['username'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($FullName) || empty($username) || empty($phone) || empty($email) || empty($gender) || empty($password) || empty($confirm_password)
        ) {
            echo "All fields are required";
        }
        else if ($password != $confirm_password) {
            echo "Passwords do not match";
        }
        else if (strlen($password) < 8) {
            echo "Password must be at least 8 characters";
        }
        else {
            //echo "Registration successful";
            $enc_password = md5($password);
            $query = "insert into users(username,password) VALUES('$username','$enc_password')";
            if(mysqli_query($conn,$query)){
                echo "Registration successful";
            }
            else{
                echo "Failed to register user";
            }
        }
    }
    /* User Data Edit */
    else if($_POST['btnsubmit'] == "Update User"){
        $uid = base64_decode(base64_decode($_POST['uid']));
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if((strlen($uid) > 0 && $uid != "") && (strlen($username) > 0 && $username != "")){
            $CheckUserQuery = "select id,username from users where id = $uid";
            $checkUserRes = mysqli_query($conn,$CheckUserQuery);
            $checkUserCnt = mysqli_num_rows($checkUserRes);
            if($checkUserCnt > 0){
                $updateUserQuery = "update users set username= '$username',contact='$phone',email='$email' where id = $uid";
                if(mysqli_query($conn,$updateUserQuery)){
                    ?>
                    <script>
                        alert("User Data Updated!");
                        window.location.href='dashboard.php';
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert("Failed to Update Data of User!");
                        window.location.href='user_edit.php?id=<?php echo $uid ?>';
                    </script>
                    <?php
                }
            }
            else{
                header("Location:dashboard.php");
            }
        }
    }
}
?>