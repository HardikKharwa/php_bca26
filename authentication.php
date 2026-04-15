<?php
require_once('database.php');
include("includes/functions.inc.php");
session_start();
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
        } else if (strlen($password) < 8) {
            $_SESSION['error'] = "1";
            $_SESSION['message'] = "Password must be at least 8 characters";
            header("Location:login.php");
            echo "Password must be at least 8 characters";
        } else if (strlen($password) > 8) {
            $userData = getUserData($conn, "", $username, "");
            //mysqli_query -> It executes the query from the db and stores the data in obj format
            //$res = mysqli_query($conn,$query);
            // mysqli_num_rows -> IT fetches the count of resultset that is fetched from the query
            //$cnt = mysqli_num_rows($res);
            //if($cnt > 0){
            if (count($userData) > 0) {
                //mysqli_fetch_assoc -> Converts data from object format to Array format
                //$row = mysqli_fetch_assoc($res);
                $row = $userData[0]['password'];
                if ($row == md5($password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['isloggedIn'] = "1";
                    header("Location: dashboard.php");
                    echo "Login successful";
                } else {
                    $_SESSION['error'] = "1";
                    $_SESSION['message'] = "Login Failed, Try Again!";
                    header("Location:login.php");
                }
            } else {
                $_SESSION['error'] = "1";
                $_SESSION['message'] = "User not Found, Kindly Register";
                header("Location:login.php");
            }
        } else {
            $_SESSION['error'] = "1";
            $_SESSION['message'] = "Some error occured, Try Again!";
            header("Location:login.php");
            echo "Login failed";
        }
    }

    /* REGISTER */ else if ($_POST['btnsubmit'] == "Register") {

        $FullName = $_POST['FullName'] ?? '';
        $username = $_POST['username'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (
            empty($FullName) || empty($username) || empty($phone) || empty($email) || empty($gender) || empty($password) || empty($confirm_password)
        ) {
            echo "All fields are required";
        } else if ($password != $confirm_password) {
            echo "Passwords do not match";
        } else if (strlen($password) < 8) {
            echo "Password must be at least 8 characters";
        } else {
            //echo "Registration successful";
            $userData = getUserData($conn, "", $username, "");
            if (count($userData) == 0) {
                $enc_password = md5($password);
                $query = "insert into users(username,password) VALUES('$username','$enc_password')";
                if (mysqli_query($conn, $query)) {
                    echo "Registration successful";
                } else {
                    echo "Failed to register user";
                }
            } else {
                echo "User Already Registered, Kindly Login";
            }
        }
    }
    /* User Data Edit */ else if ($_POST['btnsubmit'] == "Update User") {
        $uid = base64_decode(base64_decode($_POST['uid']));
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if ((strlen($uid) > 0 && $uid != "") && (strlen($username) > 0 && $username != "")) {
            $checkUserData = getUserData($conn, $uid, "", "");
            if (count($checkUserData) > 0) {
                $updateUserQuery = "update users set username= '$username',contact='$phone',email='$email' where id = $uid";
                if (mysqli_query($conn, $updateUserQuery)) {
?>
                    <script>
                        alert("User Data Updated!");
                        window.location.href = 'dashboard.php';
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("Failed to Update Data of User!");
                        window.location.href = 'user_edit.php?id=<?php echo $uid ?>';
                    </script>
<?php
                }
            } else {
                header("Location:dashboard.php");
            }
        }
    }
    /* Upload User Image */ else if ($_POST['btnsubmit'] == "Upload User Image") {
        $user_id = base64_decode($_SESSION['user_id']);
        $checkUser = getUserData($conn, $user_id, "", "");
        $file_path = "image_user/";         //Folder where te image will be sabed
        if (count($checkUser) > 0) {

            if (is_uploaded_file($_FILES['user_image']['tmp_name'])) {
                $filename = $_FILES['user_image']['name'];
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $allowed_extension = ['.jpg, .jpeg, .png'];
                if (in_array($extension, $allowed_extension)) {
                    if ($_FILES['user_image']['size'] < 5000000) {
                        // echo "File size is valid";
                        $save_file = $file_path . $filename;
                        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $save_file)) {
                            //echo "File saved to directory";
                            $updateImageQuery = "update users set image_path = '$filename' where id = $user_id";
                            if (mysqli_query($conn, $updateImageQuery)) {
                                echo "user Image Saved Successfully";
                                $_SESSION['error'] = "1";
                                $_SESSION['message'] = "user Image Saved Successfully";
                                header("Location:profile.php");
                            }
                        } else {
                            // echo "Failed tp upload image";
                            $_SESSION['error'] = "0";
                            $_SESSION['message'] = "Failed tp upload image";
                            header("Location:profile.php");
                        }
                    } else {
                        echo "File size is greater than 5MB";
                        $_SESSION['error'] = "0";
                        $_SESSION['message'] = "File size is greater than 5MB";
                        header("Location:profile.php");
                    }
                } else {
                    echo "Please select file of valid extension";
                    $_SESSION['error'];
                }
            }
        } else {
            echo "Please select file";
        }
    }
}
?>