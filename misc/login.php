<?php
session_start();
require 'conn.php';
$username = $conn->escape_string($_POST['userne']);
$upassword = $conn->escape_string($_POST['userpass']);
//$c_usr = $conn->query("select * from user where u_name='$username' ");
$c_mail = $conn->query("select * from user where u_email='$username' ");
//echo  $upassword;
if ($c_mail->num_rows > 0  )
{
$user = $c_mail->fetch_assoc();
if (password_verify($_POST['userpass'],$user['u_pass']))
{
    $_SESSION['user_role'] = $user['role_id'];
    $_SESSION['f_name'] = $user['u_fname'];
    $_SESSION['lname'] = $user['u_lname'];
    if ($_SESSION['user_role']=='1')
    {
        header("Location: /admin.php" );
    }
    if ($_SESSION['user_role']=='2')
    {
        header("Location: /water.php" );
    }
    if ($_SESSION['user_role']=='3')
    {
        header("Location: /traffic.php" );
    }
    if ($_SESSION['user_role']=='4')
    {
        header("Location: /slights.php" );
    }
    if ($_SESSION['user_role']=='5')
    {
        header("Location: /wasteb.php" );
    }
    if ($_SESSION['user_role']=='6')
    {
        header("Location: /parking.php" );
    }

}
else{
    echo "incorrect password";
}
}
else
{
    echo "incorrect  email";
}
