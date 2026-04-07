<?php
include("database.php");
if(isset($_GET['id'])){
    $id = base64_decode(base64_decode($_GET['id']));
    $enc_id =$_GET['id'];
    $query = "select * from users where id = $id";
    $res = mysqli_query($conn,$query);
    $cnt = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    if($cnt <= 0){
        header("Location:dashboard.php");
    }
}
else{
    header("Location:logout.php");
}
?>
<html>
    <head><title>User Edit</title></head>
    <body>
        <form action="authentication.php" method="post">
            <input type="hidden" name="uid" value="<?php echo $enc_id ?>"  required />
            Enter Your Username:
            <input type="text" name="username" value="<?php echo $row['username']  ?>" placeholder="Enter username" required>
            <br>

            Enter Your Phone Number:
            <input type="text" name="phone" value="<?php echo $row['contact']  ?>" placeholder="Enter phone number" required>
            <br>

            Enter Your Email:
            <input type="email" name="email" value="<?php echo $row['email']  ?>" placeholder="Enter email" required>
            <br>

            <div class="button">
                <input type="submit" name="btnsubmit" value="Update User" style="padding:5px 15px;">
            </div>

        </form>
    </body>
</html>