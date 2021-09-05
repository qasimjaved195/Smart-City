<?php
require 'conn.php';
$sql = "select * from role ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add user</title>
</head>
<body>
<form action="aduser.php" method="post">
    <input type="text" placeholder="First Name" name="fname"> <br>
    <input type="text" placeholder="Last Name" name="lname"> <br>
<!--    <input type="text" placeholder="user Name" name="uname"> <br>-->
    <input type="email" placeholder="Email" name="mail"> <br>
    <input type="password" placeholder="password" name="pass"> <br>
    <select name="role" id="role" required>
        <?php
        while ($row = mysqli_fetch_assoc($result))
        {
//            echo $row['role_id'];
            echo '<option value='.$row['role_id'].'>'.$row['role_name'].'</option>';
        }
        ?>
    </select> <br>
    <input type="submit" value="add">
</form>
</body>
</html>