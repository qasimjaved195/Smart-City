<?php
session_start();
require '../conn.php';
$email = $conn->escape_string($_POST['email']);
$upassword = $conn->escape_string($_POST['password']);
//$c_usr = $conn->query("select * from user where u_name='$username' ");
$c_mail = $conn->query("select * from user where u_email='$email' ");
//echo  $upassword;
if ($c_mail->num_rows > 0  )
{
$user = $c_mail->fetch_assoc();
if (password_verify($_POST['password'],$user['u_pass']))
{
    $_SESSION['user_role'] = $user['m_id'];
    $_SESSION['user_id'] = $user['u_id'];
    $userRole = $_SESSION['user_role']; 
    $_SESSION['f_name'] = $user['u_fname'];
    $_SESSION['l_name'] = $user['u_lname'];
    $_SESSION['user_email'] = $user['u_email'];
    echo "login succefully";
    $getRoleQ = "select * from modules where m_id='$userRole' ";
    $getRoleR = $conn->query($getRoleQ);
    $roleRow = $getRoleR->fetch_assoc();
    $roleName =  strtolower(str_replace(" ","",$roleRow['m_name']));
    
    $_SESSION['sroleName'] = $roleName;

    header("Location: ../view/$roleName.php?mid=$userRole");
    // if ($_SESSION['user_role']=='1')
    // {
    //     header("Location: /admin.php" );
    // }
    // if ($_SESSION['user_role']=='2')
    // {
    //     header("Location: /water.php" );
    // }
    // if ($_SESSION['user_role']=='3')
    // {
    //     header("Location: /traffic.php" );
    // }
    // if ($_SESSION['user_role']=='4')
    // {
    //     header("Location: /slights.php" );
    // }
    // if ($_SESSION['user_role']=='5')
    // {
    //     header("Location: /wasteb.php" );
    // }
    // if ($_SESSION['user_role']=='6')
    // {
    //     header("Location: /parking.php" );
    // }

}
else{
    $_SESSION['err'] = "Incorrect Password";
    header("Location: index.php");
    // echo "incorrect password";
}
}
else
{
    $_SESSION['err'] = "Incorrect Email";
    header("Location: index.php");
    // echo "incorrect  email";
}
