<?php
session_start();
ob_start();
if ($_SESSION['user_role'] != 25 || !isset($_SESSION['user_role']))  {
    header("Location: ../login/index.php");
}
include 'mail.php';
include 'header.php';
require '../conn.php';
$getModuleQ = "SELECT * FROM modules";
$getUserQ = "SELECT * FROM user";
$getModuleR = $conn->query($getModuleQ);
$getModuleR1 = $conn->query($getModuleQ);
$getUserR = $conn->query($getUserQ);
?>
<div class="container">
    <?php if (isset($_SESSION['err'])): ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 alert alert-danger" role="alert">
            <?php echo $_SESSION['err']; ?>
        </div>
    </div>
    <?php endif; unset($_SESSION['err']); ?>
    <?php if (isset($_SESSION['succ'])): ?>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 alert alert-success" role="alert">
            <?php echo $_SESSION['succ']; ?>
        </div>
    </div>
    <?php endif; unset($_SESSION['succ']); ?>
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="table table-dark table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>User Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($getUserR)): ?>
                    <tr>
                        <td style="width:60%"><?php echo $row['u_fname']." ".$row['u_lname'];?> <br>
                            <?php echo $row['u_email'];?> </td>
                        <td style="width:20%"><button class="btn btn-success"
                                onclick="editUser('<?php echo $row['u_id'] ?>','<?php echo $row['u_email']; ?>');"
                                data-toggle="modal" data-target="#editUser">Update</button></td>
                        <td style="width:20%"><button class="btn btn-danger"
                                onclick="delUser('<?php echo $row['u_id'] ?>','<?php echo $row['u_email']; ?>');"
                                data-toggle="modal" data-target="#delUser">Delete</button></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 ">
            <div class="d-flex justify-content-center">
                <button class="btn btn-dark btn-lg" data-toggle="collapse" data-target="#collapseNewUser"
                    aria-expanded="false" aria-controls="collapseNewUser">Add new user</button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="collapse" id="collapseNewUser">
                    <form class="text-white" action="" method="post" style="width:100%">
                        <div class="form-group">
                            <label for="FullName">Enter First name</label>
                            <input type="text" class="form-control" name="fname" id="fname"
                                placeholder="First name" required oninvalid="this.setCustomValidity('Enter First Name Here')"
    oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="FullName">Enter Last name</label>
                            <input type="text" class="form-control" name="lname" id="lname"
                                placeholder="Last name" required oninvalid="this.setCustomValidity('Enter Last Name Here')"
    oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="userName">Enter User email</label>
                            <input type="email" class="form-control " name="usermail" id="usermail"
                                placeholder="mmehran" required>
                            <!-- <small id="userhelp" class="form-text text-muted">Enter Unique user name</small> -->
                        </div>
                        <div class="form-group">
                            <label for="userName">Enter Password</label>
                            <input type="password" class="form-control " name="userpass" id="userpass"
                                placeholder="password">
                            <small id="userhelp" class="form-text">Password should 6 to 12 characters
                                long</small>
                        </div>
                        <div class="form-group">
                            <label for="userRole">Select User Role</label>
                            <select class="form-control" name="urole" id="urole">
                                <?php
                          while ($row = mysqli_fetch_assoc($getModuleR))
                          {
                            echo '<option value='.$row['m_id'].'>'.$row['m_name'].'</option>';
                          } $getModuleR->free();
                        ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update user information </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#collapseEditMail" aria-expanded="false"
                            aria-controls="collapseEditMail">Update user's email </button>
                        <div class="collapse" id="collapseEditMail">
                            <form action="" method="post" class="form-inline">
                                <input type="hidden" name="updateId" id="updateId">
                                <input type="email" id="updateEmail" name="updateEmail" class="form-control"
                                    placeholder="Enter new email">
                                <button class="btn btn-success" type="submit">Update</button>

                            </form>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#collapseEditPass" aria-expanded="false"
                            aria-controls="collapseEditPass">Update user's password </button>
                        <div class="collapse" id="collapseEditPass">
                            <form action="" method="post" class="form">
                                <input type="hidden" name="updateId1" id="updateId1">
                                <input type="hidden" name="mailFem" id="mailFem">
                                <input type="password" id="updatePass" name="updatePass" class="form-control"
                                    placeholder="Enter new password">
                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#collapseEditRole" aria-expanded="false"
                            aria-controls="collapseEditRole">Update user's role </button>
                        <div class="collapse" id="collapseEditRole">
                            <form action="" method="post" class="form">
                                <input type="hidden" name="updateId2" id="updateId2">
                                <input type="hidden" name="mailFem1" id="mailFems1">
                                <select class="form-control" name="updateRole" id="updateRole">
                                    <?php
                          while ($row = mysqli_fetch_assoc($getModuleR1))
                          {
                            echo '<option value='.$row['m_id'].'>'.$row['m_name'].'</option>';
                          } $getModuleR1->free();
                        ?>
                                </select>
                                <button class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<!-- Delete variable Modal -->
<div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="delUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-center">Are you sure you want to delete this User <strong
                                id="delEmail"></strong></p>
                        </h4>
                        <input type="hidden" name="delid" id="delid">
                        <div class="row justify-content-center">
                            <button type="submit" name="deleteA" id="deleteA" class="btn btn-danger m-1">Yes</button>
                            <button type="button" name="close" id="close" data-dismiss="modal"
                                class="btn btn-primary m-1">No</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
function editUser(uid, umail) 
{
    var userId = document.getElementById("updateId");
    var userId1 = document.getElementById("updateId1");
    var userId2 = document.getElementById("updateId2");
    var mailFem = document.getElementById("mailFem");
    var mailFem1 = document.getElementById("mailFem1");
    var userMail = document.getElementById("updateEmail");
    // alert(uid+umail);
    userId.value = uid;
    userId1.value = uid;
    userId2.value = uid;
    mailFem.value = umail;
    mailFem1.value = umail;
    userMail.value = umail;
    $("#editUser").modal();
    return false;
}

function delUser(uid, umail)
{
    var delId = document.getElementById("delid");
    var delMail = document.getElementById("delEmail");
    delId.value = uid;
    delMail.innerText = umail;
    $("#delUser").modal();
}
setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
}, 3000);
</script>
<?php
// include 'footer.php';
if (isset($_POST['fname'])) 
{
    $fname= $conn->escape_string($_POST['fname']);
    $last = $conn->escape_string($_POST['lname']);
    $email = $conn->escape_string($_POST['usermail']);
    $pass = $conn->escape_string(password_hash($_POST['userpass'],PASSWORD_BCRYPT));
    $role = $_POST['urole'];
    $passforE = $_POST['userpass'];
    //$c_usr = $conn->query("select * from user where u_name='$uname' ");
    $c_mail = $conn->query("select * from user where u_email='$email' ");
    if ($fname == "" || $last == "" || $email == "" || $passforE == "") {
        $_SESSION['err'] = "Something is missing please re-enter your data.";
        header("Location: user.php");
        exit();
    }
    if ($c_mail->num_rows > 0)
    {
        $_SESSION['err'] = "Email already exist";
        header("Location: user.php");
        exit();
    }
    if (strlen($passforE) < 6) {
        $_SESSION['err'] = "Please use Strong Password";
        header("Location: user.php");
        exit();
    }
    $ins = "insert into user (u_fname,u_lname,u_email,u_pass,m_id)".
        "VALUES ('$fname','$last','$email','$pass','$role')";
    $template = "welcome $fname  $last <br>";
    $template .= "your login credentials are: <br>";
    $template .= "<h3>email: <b>$email</b></h3>";
    $template .= "<h3>Password: <b>$passforE</b></h3>";
    $subject = "User account activation";
    if ($conn->query($ins));
    {
        $_SESSION['succ'] = "new user added succesfully";
        sendmail($email,$subject,$template);
        header("Location: user.php");
        // echo "new user added succesfully";
    }
}
if (isset($_POST['updatePass']))
{ 
    $updatePass = $conn->escape_string(password_hash($_POST['updatePass'],PASSWORD_BCRYPT));
    $updateId = $conn->escape_string($_POST['updateId1']);
    $passforE = $conn->escape_string($_POST['updatePass']);
    $mailFem = $conn->escape_string($_POST['mailFem']);
    $updt = "UPDATE user SET u_pass='$updatePass' where u_id=$updateId";
    $template = "Your Password has been updated successfully as per your request <br> New Password: <b> $passforE </b> ";
    $subject = "Password update for smart city portal";
    if ($conn->query($updt)) {
        $_SESSION['succ'] = "Password updated succesfully";
        sendmail($mailFem,$subject,$template);
        header("Location: user.php");
    }
    else {
        $_SESSION['err'] = "SOmething went wrong";
    header("Location: user.php");
    }
}
if (isset($_POST['updateEmail']))
{
    $updateEmail = $conn->escape_string($_POST['updateEmail']);
    $updateId = $conn->escape_string($_POST['updateId']);
    $c_mail = $conn->query("select * from user where u_email='$updateEmail' ");
    if ($c_mail->num_rows > 0)
    {
        $_SESSION['err'] = "Email already exist";
        header("Location: user.php");
        exit();
    }
    $updt = "UPDATE user SET u_email='$updateEmail' where u_id=$updateId";
    $template = "Your email has been updated successfully as per your request <br> New email: <b> $updateEmail </b> ";
    $subject = "Email update for smart city portal";
    if ($conn->query($updt)) {
        $_SESSION['succ'] = "Email updated succesfully";
        sendmail($updateEmail,$subject,$template);
        header("Location: user.php");
    }
}
if (isset($_POST['updateRole']))
{
    $updateRole = $conn->escape_string($_POST['updateRole']);
    $updateId = $conn->escape_string($_POST['updateId2']);
    $mailFem = $conn->escape_string($_POST['mailFem1']);
    $updt = "UPDATE user SET m_id=$updateRole where u_id=$updateId";
    $template = "Your Role has been updated successfully  ";
    $subject = "Role update for smart city portal";
    if ($conn->query($updt)) {
        $_SESSION['succ'] = "Email updated succesfully";
        sendmail($updateEmail,$subject,$template);
        header("Location: user.php");
    }
}
if (isset($_POST['delid'])) {
    $delId = $_POST['delid'];
    $query = "delete from user where u_id='$delId'";
    $conn->query($query);
    header("Location: user.php");
}
?>