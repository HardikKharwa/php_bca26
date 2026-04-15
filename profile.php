<?php
include('database.php');

?>
<html>

<head>
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>
    <h1>My Profile</h1>
    <form action="" method="" enctype="multipart/form-data">
        Upload Your photo:
        <input type="file" name="user_image"
            accept=".jpg, .jpeg, .png" required />
        <br>
        <input type="submit" class="form-control btn btn-primary"
            name="btnsubmit" value="Upload User Image" />

    </form>
</body>

</html>