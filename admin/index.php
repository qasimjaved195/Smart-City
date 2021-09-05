<?php
ob_start();
session_start();
include 'header.php';
require '../conn.php';
if ($_SESSION['user_role'] != 25 || !isset($_SESSION['user_role']) ) {
    header("Location: ../login/index.php");
}
?>
<div class='container'>
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
<button class="btn btn-md btn-dark" data-toggle="modal" data-target="#module" >Add New Module</button>
<div class="row">
    <?php
    $sql = "select * from modules";
    $result = $conn->query($sql);
    while ($row =  mysqli_fetch_assoc($result)) {
       $mpage = strtolower (str_replace(" ","",$row['m_name'])); if ($mpage != "admin") { ?>
    <div class="col-md-4">
        <div class="card bg-secondary text-white mt-3 mb-3" style="width: 18rem;">
            <div class="card-header">
                <?php echo $row['m_name']; ?>
            </div>
            <ul class="list-group list-group-flush ">
               <a class=" btn btn-md btn-dark" href="../view/<?php echo $mpage; ?>.php?mid=<?php echo $row['m_id']; ?>"> <li > View Current Status</li> </a>
               <a class=" btn btn-md btn-dark" href="modulem.php?mid=<?php echo $row['m_id']; ?>&mname=<?php echo $row['m_name']; ?>"> <li > Manage Module</li> </a>
               <li class="bg-dark">
               <div class="row">
               <div class="col-md-6">
               <button  class="btn btn-md btn-primary col-sm-12  " onclick="updateModule('<?php echo $row['m_id'];?>','<?php echo $row['m_name'];?>')" >Edit</button> 
               </div>
               <div class="col-md-6">
               <button  class="btn btn-md btn-danger col-sm-12 " onclick="deleteModule('<?php echo $row['m_id'];?>','<?php echo $row['m_name'];?>')"  >Delete</button> 
               </div>
               </div>
               </li>
            </ul>
        </div>
    </div>    
    <?php
       }
    }
    ?>
</div>
</div>

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
                        <label for="insModule">Enter Module Name</label>
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

<!-- Delete module Modal -->
<div class="modal fade" id="deleteModule" tabindex="-1" role="dialog" aria-labelledby="deleteModule" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-center">Are you sure you want to delete this module <strong
                        name="moduleName" id="moduleName"></strong></p>
                        <input type="hidden" name="delModule" id="delModule">
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

<!-- Update module modal  -->
<div class="modal fade" id="updateModule" tabindex="-1" role="dialog" aria-labelledby="updateModule" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                    <input type="hidden" name="edMoudleId" id="edMoudleId">
                        <label for="address">Enter New Module Name</label>
                        <input class="form-control" type="text" name="edModuleName" id="edModuleName"
                            placeholder="Parking, Water level, traffic lights, e.t.c">
                        <small class="form-text text-muted">Change/Edit module naame</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
}, 3000);
function deleteModule(mid, mname) {
    var moduleName = document.getElementById("moduleName");
    var moduleId = document.getElementById("delModule");
    moduleName.innerHTML = mname;
    moduleId.value = mid;
    $("#deleteModule").modal();
    return false;
}
function updateModule(mid, mname) {
    var edModuleName = document.getElementById("edModuleName");
    var edMoudleId = document.getElementById("edMoudleId");
    edModuleName.value = mname;
    edMoudleId.value = mid;
    $("#updateModule").modal();
    return false;
}
</script>

<?php
include 'footer.php';
if (isset($_POST['insModule'])) {
    $mName = $_POST['insModule'];
    $query = "insert into modules (m_name) values('$mName')";
    $conn -> query($query);
    $createf = fopen("../view/$mName.php",'a') or die("Unable to open file!");
    $writef = "<?php \ninclude 'header.php'; \n require '../conn.php'; ?> \n \n \n 
<?php
include 'footer.php';
?>";
    fwrite($createf,$writef);
    fclose($createf);
    header("Location: index.php ");
}
if (isset($_POST['delModule'])) {
    $dellModule = $_POST['delModule'];
    $moduleName = $_POST['moduleName'];
    $query = "delete from modules where m_id='$dellModule'";
    $conn -> query($query);
    unlink("../view/$moduleName.php");
    header("Location: index.php");
}
if (isset($_POST['edMoudleId'])) {
    $editMid = $_POST['edMoudleId'];
    $editMname = $_POST['edModuleName'];
    $query = "update modules set m_name='$editMname' where m_id='$editMid'";
    $conn -> query($query);
    header("Location: index.php");
}

ob_end_flush();
?>