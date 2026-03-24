<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

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

            Enter Your Full Name:
            <input type="text" name="FullName" placeholder="Enter Full Name" required>
            <br>

            Enter Your Username:
            <input type="text" name="username" placeholder="Enter username" required>
            <br>

            Enter Your Phone Number:
            <input type="tel" name="phone" placeholder="Enter phone number" required>
            <br>

            Enter Your Email:
            <input type="email" name="email" placeholder="Enter email" required>
            <br>

            Enter Your Gender:
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female"> Female
            <input type="radio" name="gender" value="Other"> Other
            <br>

            Enter Your Password:
            <input type="password" name="password" placeholder="Enter password" required>
            <br>

            Confirm Your Password:
            <input type="password" name="confirm_password" placeholder="Confirm password" required>
            <br>

            <div class="button">
                <input type="submit" name="btnsubmit" value="Register" style="padding:5px 15px;">
            </div>

        </form>
    </div>
</body>

</html>