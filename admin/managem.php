<?php
ob_start();
include 'header.php';
require '../conn.php';
$mid = $_GET['mid'];
$mname = $_GET['mname'];
$getareaQ = "select * from area where m_id='$mid'";
$getareaR = $conn->query($getareaQ);
?>
<div class="container">
<h2 class='text-center'> <?php echo "Manage ".$mname ?> </h2>
<div class="row ">
<div class="col-md-6">
<div class="row">
<h5 class='text-left col-sm-6' >Areas</h5>
<button type="button" class="btn btn-sm btn-dark " data-toggle="modal" data-target="#area">Add new Area</button>
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
<td><button class='btn btn-sm btn-success' onclick="updateArea('<?php echo $row['a_id']; ?>','<?php echo $row['a_name']; ?>');"  >Update</button></td>
<td><button class='btn btn-sm btn-danger' onclick="deleteArea('<?php echo $row['a_id']; ?>','<?php echo $row['a_name']; ?>');"  >Delete</button></td>
</tr>
<?php }?>
</tbody>
</table>
</div>
<div class="col-md-6">
<div class="row">
<h5 class="text-left col-sm-6" >Variabales</h5>
<button class="btn btn-sm btn-dark">Add new Variable</button>
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

</tbody>
</table>
<form >
<input name="tst" id="tst" type="text">
<button type="button" onclick="post();" >tst</button>
</div>
</div>
<!-- New Are Modal -->
</div>
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
      <input class="form-control" type="text" name="address" id="address" placeholder="City name, Town/Colony name, Street No.">
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

<!-- s -->
<!-- Delete Area Modal -->
<!-- <div class="modal fade" id="deleteArea" tabindex="-1" role="dialog" aria-labelledby="area" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <form action="" method="post">
      <div class="modal-body">
      <div class="form-group">
      <p class="text-center" >Are you sure you want to delete this are <strong id="areaNames" ></strong> <br>from <?php echo $mname; ?></h4>
      <input type="hidden" name="deleteAid" id="deleteAid">
      <div class="row justify-content-center">
      <button type="submit" name="deleteA" id="deleteA" class="btn btn-danger m-1">Yes</button>
      <button type="button" name="close" id="close" data-dismiss="modal" class="btn btn-primary m-1">No</button>
      </div>
      </div>
      </div>
      </form>
    </div>
  </div>
</div> -->


<!-- <script>
function updateArea(aid,aname) {
    var addr = document.getElementById("updateAname");
    var addrId = document.getElementById("updateAid");
               addr.value = aname;
               addrId.value = aid;
            $("#updateArea").modal();
            return false;
}
function deleteArea(aid,aname) {
    var addr = document.getElementById("areaNames");
    var addrId = document.getElementById("deleteAid");
    addr.innerHTML = aname;
    addrId.value = aid;
            $("#deleteArea").modal();
            return false;
}
</script> -->
<?php
include 'footer.php';
if (isset($_POST['address'])) {
    $mAddress = $_POST['address'];
    $query = "insert into area (m_id,a_name) values($mid,'$mAddress')";
    $conn->query($query);
    header("Location: managem.php?mid=$mid&mname=$mname");
}

if (isset($_POST['updateAname'])) {
    $updateAname = $_POST['updateAname'];
    $updateAid = $_POST['updateAid'];
    $query = "update area set a_name='$updateAname' where a_id='$updateAid'";
    $conn->query($query);
    header("Location: managem.php?mid=$mid&mname=$mname");
}
if (isset($_POST['deleteAid'])) {
    
    $deleteAid = $_POST['deleteAid'];
    $query = "delete from area where a_id='$deleteAid'";
    $conn->query($query);
    header("Location: managem.php?mid=$mid&mname=$mname");
}
ob_end_flush();
?>