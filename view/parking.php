<?php
ob_start();
session_start();
require '../conn.php';
if ($_SESSION['user_role'] != 3 && $_SESSION['user_role'] != 25 || !isset($_SESSION['user_role']) ) {
    header("Location: ../login/index.php");
}
$moduleId = $_GET['mid'];
$_SESSION['moduleId'] = $moduleId;
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['pageAdrs'] = basename($_SERVER['PHP_SELF'])."?mid=".$moduleId;
$getFirstAQ = "select a_id from area where m_id = $moduleId LIMIT 1";
$getFirstAR = $conn->query($getFirstAQ);
$getRow = mysqli_fetch_assoc($getFirstAR);
$getAid = $getRow['a_id'];
if (isset ($_POST['reqar'])) {
	$getAid = $_POST['reqar'];
}
$getVar = "select * from mvariables where a_id=$getAid";
$getVarR = $conn->query($getVar);
$getVarR2 = $conn->query($getVar);
$getMnameQ = "select * from modules where m_id = $moduleId";
$getMnameR = $conn->query($getMnameQ);
$getNameRow = mysqli_fetch_assoc($getMnameR);
$mName = $getNameRow['m_name'];
include 'header.php';
?>
<?php?>
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
<h2 class='text-center text-white'> <?php echo $mName." Status" ?> </h2>
<div class='row pt-5'>
<?php while ($row = mysqli_fetch_assoc($getVarR)): 
$varName = strtolower (str_replace(" ","",$row['mv_name']));
?>
<div class="col-md-3">
<div class="card text-white bg-dark mt-3" style="max-width: 18rem; max-height: 18rem;">
<div class="card-header">
<?php echo "Car ".$varName;  ?>
</div>
<div class="card-body">
<p class="<?php echo 'cartx'.$varName;?>" style="visibility: hidden;" >Empty</p>
<img class="<?php echo 'carimg'.$varName;?>" src="img/car.png" alt="" height="300px" width="350px" style="padding-top:-150px; padding-right: 100px; padding-bottom:150px; visibility: hidden; " >
</div>
</div>
</div>
<?php endwhile; $getVarR->free(); ?>
</div>
</div>
</div>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
    <script src="wasteBin.js"></script>   
    <script>
	setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
}, 3000);
     $(document).ready(function(){
		
		fetch_data();
        setInterval(function(){
 fetch_data();
}, 1000);
function fetch_data()
	{
		var action = "parking";
		var a_id = "<?php echo $getAid;?>";
		// alert(a_id);
		$.ajax({
		url:"client.php",
		method:"POST",
		data:{action:action, a_id:a_id},
		success:function(data)
		{
			var i = 0;
            var res = JSON.parse(data);
            // alert(res);
            <?php while ($row = mysqli_fetch_assoc($getVarR2)): 
			$varName = strtolower (str_replace(" ","",$row['mv_name']));
            ?>
            if (res["<?php echo $varName; ?>"] == "1") {
                console.log("true");
                $("<?php echo '.carimg'.$varName;?>").css("visibility","visible");
                $("<?php echo '.cartx'.$varName;?>").css("visibility","hidden");
            }
            else
            {
                console.log("false");
                $("<?php echo '.carimg'.$varName;?>").css("visibility","hidden");
                $("<?php echo '.cartx'.$varName;?>").css("visibility","visible");
            }
			
			
			
			<?php endwhile; $getVarR2->free(); ?>
		
		}
		});
	}
     });
    
    </script>
<?php
include 'footer.php';
ob_end_flush();
?>