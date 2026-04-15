<?php
include("database.php");
include("includes/functions.inc.php");
session_start();
$user_id = base64_decode($_SESSION['user_id']);
?>
<html>

<head>
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="container">
    <h3>My Profile</h3>
    <?php
    if (isset($_SESSION['error']) && isset($_SESSION['message'])) {
        if ($_SESSION['error'] != "" && $_SESSION['message'] != "") {
            $msg = $_SESSION['message'];
            if ($_SESSION['error'] == "1") {
                $status = "success";
            } else if ($_SESSION['error'] == "0") {
                $status = "danger";
            }
            echo "<div class='btn btn-" . $status . "'>
                        " . $msg . "
                    </div>";
            unset($_SESSION['error']);
            unset($_SESSION['message']);
        }
    }
    ?>
    <form action="authentication.php" method="POST" enctype="multipart/form-data">
        Upload Your Photo:
        <input class="form-control" type="file" name="user_image"
            accept=".jpg,.jpeg,.png" required />
        <br>
        <input type="submit"
            class="form-control btn btn-primary"
            name="btnsubmit" value="Upload User Image" />
    </form>
    <div class="container">
        <strong>Users Profile Image</strong><br />
        <?php
        $userData = getUserData($conn, $user_id, "", "");
        if ($userData[0]['image_path'] != "") {
        ?>
            <img src="images_user/<?php echo $userData[0]['image_path']; ?>"
                alt="<?php echo $userData[0]['username'] . 'Profile Image' ?>"
                style="height:50%;border-radius:10px;" />
        <?php
        } else {
            echo "No Image Found for User";
        }
        ?>
    </div>
</body>
</body>

</html>