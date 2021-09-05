<?php
session_start();
if (isset($_SESSION['user_role']))
    {
        if ($_SESSION['user_role'] == '1') {
            echo "welcome to admin page";
    }
    else
        {
            echo "you don't have permission to access this page";
        }

}
else
{
    header("Location: index.php");
}
?>