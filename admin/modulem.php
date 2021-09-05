<?php
ob_start();
session_start();
include 'header.php';
require '../conn.php';
if ($_SESSION['user_role'] != 25 || !isset($_SESSION['user_role'])) {
    header("Location: ../login/index.php");
}
$mid = $_GET['mid'];
$mname = $_GET['mname'];
  $getareaQ = "select * from area where m_id='$mid'";
$getareaR = $conn->query($getareaQ);
$res = $conn->query($getareaQ);
$res1 = $conn->query($getareaQ);
$getVarQ = "select * from mvariables where m_id='$mid'";
$getVarR = $conn->query($getVarQ);
?>

<div class="container">
    <h2 class='text-center text-white'> <?php echo "Manage ".$mname ?> </h2>
    <div class="row ">
        <div class="col-md-6">
            <div class="row">
                <h5 class='text-left col-sm-6'>Areas</h5>

                <button type="button" class="btn btn-sm btn-dark " data-toggle="modal" data-target="#area">Add new
                    Area</button>
            </div>
            <table class="table table-dark table-hover mt-2">
                <thead>
                    <tr>
                        <th width='80%'>Name</th>
                        <th width='20%'>Edit</th>
                        <th width='20%'> Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($getareaR)) { ?>
                    <tr>
                        <td><?php echo $row['a_name']; ?></td>
                        <td><button class='btn btn-sm btn-success'
                                onclick="updateArea('<?php echo $row['a_id']; ?>','<?php echo $row['a_name']; ?>');">Update</button>
                        </td>
                        <td><button class='btn btn-sm btn-danger'
                                onclick="deleteArea('<?php echo $row['a_id']; ?>','<?php echo $row['a_name']; ?>');">Delete</button>
                        </td>
                    </tr>
                    <?php } $getareaR->free(); ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="row">
                <h5 class="text-left col-sm-6">Variabales</h5>
                <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#variable">Add new
                    Variable</button>

            </div>
            <table class="table table-dark table-hover mt-2">
                <thead>
                    <tr>
                        <th width='40%'>Variable Name</th>
                        <th width='40%'>Variable Area</th>
                        <th width='20%'>Edit</th>
                        <th width='20%'> Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($getVarR)) { ?>
                    <tr>
                        <td><?php echo $row['mv_name']; ?></td>
                        <?php $arid = $row['a_id'];
                         $showAreaQ = "select a_name from area where a_id=$arid";
                         $showAreaR =  mysqli_fetch_assoc($conn->query($showAreaQ)); 
                         ?>
                        <td> <?php echo $showAreaR['a_name']; ?> </td>
                        <td><button class='btn btn-sm btn-success'
                                onclick="updateVr('<?php echo $row['mv_id']; ?>','<?php echo $row['mv_name']; ?>','<?php echo $row['min']; ?>','<?php echo $row['max']; ?>');">Update</button>
                        </td>
                        <td><button class='btn btn-sm btn-danger'
                                onclick="deleteVr('<?php echo $row['mv_id']; ?>','<?php echo $row['mv_name']; ?>');">Delete</button>
                        </td>
                    </tr>
                    <?php } $getVarR->free(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- New Are Modal -->
<div class="modal fade" id="area" tabindex="-1" role="dialog" aria-labelledby="area" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new area for <?php echo $mname?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Enter Address</label>
                        <input class="form-control" type="text" name="address" id="address"
                            placeholder="City name, Town/Colony name, Street No.">
                        <small class="form-text text-muted">Enter the address where your module is located</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Edit Area Modal -->
<div class="modal fade" id="updateArea" tabindex="-1" role="dialog" aria-labelledby="area" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit area for <?php echo $mname?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="address">Enter Address</label>
                        <input type="hidden" id="updateAid" name="updateAid">
                        <input class="form-control" type="text" name="updateAname" id="updateAname"
                            placeholder="City name, Town/Colony name, Street No.">
                        <small class="form-text text-muted">Update the address where your module is located</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateA" id="updateA" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Area Modal -->
<div class="modal fade" id="deleteArea" tabindex="-1" role="dialog" aria-labelledby="area" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-center">Are you sure you want to delete this are <strong id="areaNames"></strong>
                        </p>
                        <br>from <?php echo $mname; ?></h4>
                        <input type="hidden" name="deleteAid" id="deleteAid">
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

<!-- New Variable Modal -->
<div class="modal fade" id="variable" tabindex="-1" role="dialog" aria-labelledby="variable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Variable for <?php echo $mname?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="area">Select area</label>
                        <select class="form-control" name="areaId" id="areaId">
                            <?php
                          while ($row = mysqli_fetch_assoc($res))
                          {
                            echo '<option value='.$row['a_id'].'>'.$row['a_name'].'</option>';
                          } $res->free();
                        ?>
                        </select>
                        <label for="variable">Enter variable name</label>
                        <input class="form-control" type="text" name="variable" id="variable"
                            placeholder="car1, bin1, tank1">
                        <small class="form-text text-muted">Enter the variable name for above selected area</small>
                        <div class="row">
                            <div class="col-sm-4">
                            <label for="mini">Enter Empty Value</label>
                        <input class="form-control" type="number" name="mini" id="mini"
                            placeholder="1, 2, 3">
                            </div>
                            <div class="col-sm-4">
                            <label for="max">Enter Full Value</label>
                        <input class="form-control" type="number" name="max" id="max"
                            placeholder="1, 2, 3">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit variable modal -->
<div class="modal fade" id="updateVr" tabindex="-1" role="dialog" aria-labelledby="updateVr" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Variabale for <?php echo $mname?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="area">Select updated area</label>
                        <select class="form-control" name="vareaId" id="vareaId">
                            <?php
                          while ($row = mysqli_fetch_assoc($res1))
                          {
                            echo '<option value='.$row['a_id'].'>'.$row['a_name'].'</option>';
                          } $res1->free();
                        ?>
                        </select>
                        <label for="address">Enter Updated Variable</label>
                        <input type="hidden" id="updateVid" name="updateVid">
                        <input class="form-control" type="text" name="updateVri" id="updateVri"
                            placeholder="City name, Town/Colony name, Street No.">
                        <small class="form-text text-muted">Update the selected variable</small>

                        <div class="row">
                            <div class="col-sm-4">
                            <label for="umini">Update Empty Value</label>
                        <input class="form-control" type="number" name="umini" id="umini"
                            placeholder="1, 2, 3">
                            </div>
                            <div class="col-sm-4">
                            <label for="umax">Update Full Value</label>
                        <input class="form-control" type="number" name="umax" id="umax"
                            placeholder="1, 2, 3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateA" id="updateA" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete variable Modal -->
<div class="modal fade" id="deleteVr" tabindex="-1" role="dialog" aria-labelledby="deleteVr" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-center">Are you sure you want to delete this variable <strong
                                id="varaName"></strong></p>
                        <br>from <?php echo $mname; ?></h4>
                        <input type="hidden" name="deleteVrid" id="deleteVrid">
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


<script>
function updateArea(aid, aname) {
    var addr = document.getElementById("updateAname");
    var addrId = document.getElementById("updateAid");
    addr.value = aname;
    addrId.value = aid;
    $("#updateArea").modal();
    return false;
}

function updateVr(mvid, mname, min, max) {
    var updateVri = document.getElementById("updateVri");
    var addrId = document.getElementById("updateVid");
    var umini = document.getElementById("umini");
    var umax = document.getElementById("umax");
    console.log(mvid, mname);
    updateVri.value = mname;
    addrId.value = mvid;
    umini.value = min;
    umax.value = max;
    $("#updateVr").modal();
    return false;
}

function deleteArea(aid, aname) {
    var addr = document.getElementById("areaNames");
    var addrId = document.getElementById("deleteAid");
    addr.innerHTML = aname;
    addrId.value = aid;
    $("#deleteArea").modal();
    return false;
}

function deleteVr(mvid, mvname) {
    var varaName = document.getElementById("varaName");
    var deleteVrid = document.getElementById("deleteVrid");
    varaName.innerHTML = mvname;
    deleteVrid.value = mvid;
    $('#deleteVr').modal();
    return false;
}
</script>
<?php
include 'footer.php';

if (isset($_POST['updateAname'])) {
    $updateAname = $_POST['updateAname'];
    $updateAid = $_POST['updateAid'];
    $query = "update area set a_name='$updateAname' where a_id='$updateAid'";
    $conn->query($query);
    header("Location: modulem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['updateVri'])) {
    $updateVname = $_POST['updateVri'];
    $updateVid = $_POST['updateVid'];
    $vareaId = $_POST['vareaId'];
    $umini = $_POST['umini'];
    $umax = $_POST['umax'];

    $query = "update mvariables set a_id='$vareaId', mv_name='$updateVname', min='$umini', max='$umax' where mv_id='$updateVid'";
    $conn->query($query);
    header("Location: modulem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['deleteAid'])) {
    
    $deleteAid = $_POST['deleteAid'];
    $query = "delete from area where a_id='$deleteAid'";
    $query1 = "delete from mvariables where a_id='$deleteAid'";
    $conn->query($query);
    $conn->query($query1);
    header("Location: modulem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['deleteVrid'])) {
    
    $deleteVid = $_POST['deleteVrid'];
    $query = "delete from mvariables where mv_id='$deleteVid'";
    $conn->query($query);
    header("Location: modulem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['variable'])) {
  $mVariable = $_POST['variable'];
  $areaId = $_POST['areaId'];
  $mini = $_POST['mini'];
  $max = $_POST['max'];
  $query = "insert into mvariables (a_id,m_id,mv_name,min,max) values($areaId,$mid,'$mVariable','$mini','$max')";
  $conn->query($query) or die("Query fail: " . mysqli_error());
  // header("Location: index.php");
  header("Location: modulem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['address'])) {
  $mAddress = $_POST['address'];
  $query = "insert into area (m_id,a_name) values($mid,'$mAddress')";
  $conn->query($query);
  header("Location: modulem.php?mid=$mid&mname=$mname");
}
ob_end_flush();
?>