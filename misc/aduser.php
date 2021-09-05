<?php
require 'conn.php';
$fname= $conn->escape_string($_POST['fname']);
$last = $conn->escape_string($_POST['lname']);
//$uname = $conn->escape_string($_POST['uname']);
$email = $conn->escape_string($_POST['mail']);
$pass = $conn->escape_string(password_hash($_POST['pass'],PASSWORD_BCRYPT));
$role = $_POST['role'];
//$c_usr = $conn->query("select * from user where u_name='$uname' ");
$c_mail = $conn->query("select * from user where u_email='$email' ");

if ($c_mail->num_rows > 0)
{
    echo "Email already exist";
    exit();
}
$ins = "insert into user (u_fname,u_lname,u_email,u_pass,role_id)".
    "VALUES ('$fname','$last','$email','$pass','$role')";
if ($conn->query($ins));
{
    echo "new user added succesfully";
}




