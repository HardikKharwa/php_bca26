<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        .register {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            width: 100vw;
            height: 100vh;
            background-color: lavender;
            border-radius: 10px;
            font-size: large;
        }

        form {
            background: lightgreen;
            padding: 20px;
            border-radius: 10px;
        }

        input {
            margin: 5px 0;
        }

        .button {
            text-align: center;
            margin-top: 10px;
            color: yellowgreen;
        }
    </style>
</head>

<body>
    <div class="register">
        <form action="authentication.php" method="post">
            Enter Your Username:
            <input type="text" name="username" placeholder="Enter username" required>
            <br>

            Enter Your Password:
            <input type="password" name="password" placeholder="Enter password" required>
            <br>

            <div class="button">
                <input type="submit" name="btnsubmit" value="Login" style="padding:5px 15px;">
            </div>
            <div style="color:red;text-align:center">
                <?php
                    if(isset($_SESSION['error'])){
                        if($_SESSION['error'] == "1"){
                            if(isset($_SESSION['message'])){
                                if($_SESSION['message'] != ""){
                                    echo $_SESSION['message'];
                                    unset($_SESSION['error']);
                                    unset($_SESSION['message']);
                                }
                            }
                        }
                    }
                ?>
            </div>
        </form>
    </div>
</body>

</html>