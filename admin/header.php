<?php
require '../conn.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/bootstrap.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>Admin Page</title>
</head>

<body class="image-box" style="background-image: url('includes/images/bg-01.jpg'); background-size: cover;">

    <nav class="navbar navbar-expand-lg col-lg-12 navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Smart City Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mx-auto justify-content-center">
                <li class="nav-item">
                    <a class="btn btn-md btn-dark" href="../admin/user.php">Manage Users</a>
                </li>
            </ul>
            <span class="nav-item dropdown">
                <a class="nav-link dropdown text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php if (isset($_SESSION['user_role'])) {
            echo $_SESSION['f_name']." ".$_SESSION['l_name'];
          }  ?>
                </a>
                <div class="dropdown-menu bg-dark " aria-labelledby="navbarDropdownMenuLink">

                    <Button class="btn btn-md btn-dark"
                        onclick="editCUser('<?php echo $_SESSION['user_id'] ?>','<?php echo $_SESSION['f_name']?>','<?php echo $_SESSION['l_name']?>','<?php echo $_SESSION['user_email']?>');">Edit
                        Profile</Button>
                    <Button class="btn btn-md btn-dark" onclick="logout('<?php echo $_SESSION['user_id'] ?>');" >Log Out</Button>
                </div>
            </span>
        </div>
    </nav>
    <!-- new module modal  -->
    <div class="modal fade" id="module" tabindex="-1" role="dialog" aria-labelledby="module" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="address">Enter Module Name</label>
                            <input class="form-control" type="text" name="insModule" id="insModule"
                                placeholder="Parking, Water level, traffic lights, e.t.c">
                            <small class="form-text text-muted">Enter the new module into portal</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editCUser" tabindex="-1" role="dialog" aria-labelledby="editCUser" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update your profile </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                                data-target="#collapseEditName" aria-expanded="false"
                                aria-controls="collapseEditName">Update your name </button>
                            <div class="collapse" id="collapseEditName">
                                <form action="" method="post" class="form-inline">
                                    <input type="hidden" name="userId" id="userId">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" id="updateFname" name="updateFname" class="form-control"
                                                placeholder="First Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" id="updateLname" name="updateLname" class="form-control"
                                                placeholder="Last Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                                data-target="#collapseEditMail" aria-expanded="false"
                                aria-controls="collapseEditMail">Update your email </button>
                            <div class="collapse" id="collapseEditMail">
                                <form action="" method="post" class="form-inline">
                                    <input type="hidden" name="userId1" id="userId1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="email" id="updateCEmail" name="updateCEmail"
                                                class="form-control" placeholder="Enter new email">
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                                data-target="#collapseEditPass" aria-expanded="false"
                                aria-controls="collapseEditPass">Update user's password </button>
                            <div class="collapse" id="collapseEditPass">
                                <form action="" method="post" class="form">
                                    <input type="hidden" name="userId2" id="userId2">

                                    <input type="password" id="updateCPass" name="updateCPass" class="form-control"
                                        placeholder="Enter new password">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Logout User Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-center">Are you sure you want to Log Out </p>
                        <input type="hidden" name="userId3" id="userId3">
                        <div class="row justify-content-center">
                            <button type="submit"  class="btn btn-danger m-1">Yes</button>
                            <button type="button" name="close" id="close" data-dismiss="modal"
                                class="btn btn-primary m-1">No</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
    function editCUser(uid, fname, lname, email) {
        var userId = document.getElementById("userId");
        var userId1 = document.getElementById("userId1");
        var userId2 = document.getElementById("userId2");
        var f_name = document.getElementById("updateFname");
        var l_name = document.getElementById("updateLname");
        var uemail = document.getElementById("updateCEmail");
        // alert(uid);
        // alert(fname);
        // alert(lname);
        // alert(email);
        userId.value = uid;
        userId1.value = uid;
        userId2.value = uid;
        f_name.value = fname;
        l_name.value = lname;
        uemail.value = email;
        $("#editCUser").modal();
        return false;
    }
    function logout(uid) {
      var userId = document.getElementById("userId3");
      userId.value = uid;
      $("#logoutModal").modal();
      return false;
    }
    </script>
    <?php
    
    if (isset($_POST['updateCPass']))
    { 
        $updateCPass = $conn->escape_string(password_hash($_POST['updateCPass'],PASSWORD_BCRYPT));
        $userId = $conn->escape_string($_POST['userId2']);
        $passforV = $conn->escape_string($_POST['updateCPass']);
        // $mailFem = $conn->escape_string($_POST['mailFem']);
        if (strlen($passforV) >= 6) {
          $updt = "UPDATE user SET u_pass='$updateCPass' where u_id=$userId";
        }
        else {
          $_SESSION['err'] = "Password sould 6 to 12 character long";
        header("Location: index.php");
        exit();
        }
        
        // $template = "Your Password has been updated successfully as per your request <br> New Password: <b> $passforE </b> ";
        // $subject = "Password update for smart city portal";
        if ($conn->query($updt)) {
            $_SESSION['succ'] = "Password updated succesfully";
            // sendmail($mailFem,$subject,$template);
            header("Location: index.php");
            exit();
        }
        else {
            $_SESSION['err'] = "SOmething went wrong";
        header("Location: index.php");
        }
    }
    if (isset($_POST['updateCEmail']))
    {
        $updateCEmail = $conn->escape_string($_POST['updateCEmail']);
        $userId = $conn->escape_string($_POST['userId1']);
        $c_mail = $conn->query("select * from user where u_email='$updateCEmail' ");
        if ($c_mail->num_rows > 0)
        {
            $_SESSION['err'] = "Email already exist";
            header("Location: index.php");
            exit();
        }
        $updt = "UPDATE user SET u_email='$updateCEmail' where u_id=$userId";
        // $template = "Your email has been updated successfully as per your request <br> New email: <b> $updateEmail </b> ";
        // $subject = "Email update for smart city portal";
        if ($conn->query($updt)) {
            $_SESSION['succ'] = "Email updated succesfully please re-login your account with new email";
            // sendmail($updateEmail,$subject,$template);
            session_destroy();
            header("Refresh:0");
            exit();
            // echo $_SESSION['succ'];
            // header("Location: index.php");
        }
    }
    if (isset($_POST['updateFname']) || isset($_POST['updateLname']) ) 
    {
      $fname = $conn->escape_string($_POST['updateFname']);
      $lname = $conn->escape_string($_POST['updateLname']);
      $userId = $conn->escape_string($_POST['userId']);

      $updt = "UPDATE user SET u_fname='$fname', u_lname='$lname' where u_id=$userId";
      if ($conn->query($updt)) {
        $_SESSION['succ'] = "Name updated succesfully";
        $_SESSION['f_name'] = $fname;
        $_SESSION['l_name'] = $lname;
        header("Location: index.php");
        exit();
    }
    else {
        $_SESSION['err'] = "SOmething went wrong";
    header("Location: index.php");
    }
    }
    if (isset($_POST['userId3'])) {
      session_destroy();
      header("Refresh:0");
    }

    ?>