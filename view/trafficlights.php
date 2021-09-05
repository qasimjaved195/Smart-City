<?php
ob_start();
session_start();
include 'redisconn.php';
if ($_SESSION['user_role'] != 2 && $_SESSION['user_role'] != 25 || !isset($_SESSION['user_role']) ) {
    header("Location: ../login/index.php");
}
$moduleId = $_GET['mid'];
$_SESSION['moduleId'] = $moduleId;
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['pageAdrs'] = basename($_SERVER['PHP_SELF'])."?mid=".$moduleId;
// echo $_SESSION['moduleId'];
$getFirstAQ = "select * from area where m_id = $moduleId LIMIT 1";
$getFirstAR = $conn->query($getFirstAQ);
$getRow = mysqli_fetch_assoc($getFirstAR);
$getAid = $getRow['a_id'];
if (isset ($_POST['reqar'])) {
	$getAid = $_POST['reqar'];
}
$getV = "select * from mvariables where a_id='$getAid' LIMIT 1";
$getVR = $conn->query($getV);
$getRow1 = mysqli_fetch_assoc($getVR);
$cars = $redis->get($getRow1['mv_name']);
$getMnameQ = "select * from modules where m_id = $moduleId";
$getMnameR = $conn->query($getMnameQ);
$getNameRow = mysqli_fetch_assoc($getMnameR);
$mName = $getNameRow['m_name'];

//send override info
$redis->set("t0","00");

// print_r($getRow1['mv_name']);
include 'header.php';
?>
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
<div style="padding-left: 5%;" class="container d-flex justify-content-center">

    <div class="col-lg-4" style="height: 400px; max-width: 350px;">
        <p class=" text-center text-white">Signal 1</p>
        <div class="ml-5 mb-3 d-flex justify-content-center card text-white bg-dark"
            style="max-height: 80px; max-width: 200px;">
            <div class="card-body">
                <div class="row ">
                    <span class=" mr-2 ml-2 r1"
                        style="background-color: #dc3545; height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                    <span class="mr-2 "
                        style="background-color: #bc9103; opacity: 0.4;  height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                    <span class="g1" style="background-color: #28a745; height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <p class=" text-white">Signal 2</p>

                <div class=" d-flex justify-content-center card text-white bg-dark"
                    style="max-height: 200px; max-width: 80px;">
                    <div class="card-body">
                        <div class="row ">
                            <span class=" mb-2 ml-2 r2"
                                style=" background-color: #dc3545; height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                            <span class=" mb-2 ml-2 "
                                style=" background-color: #bc9103; opacity: 0.4; height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                            <span class=" ml-2 g2"
                                style=" background-color: #28a745; height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <p class=" text-center text-white">Signal 4</p>
                <div class="ml-4 d-flex justify-content-center card text-white bg-dark"
                    style="max-height: 200px; max-width: 80px;">
                    <div class="card-body">
                        <div class="row ">
                            <span class="mb-2 ml-2 r4"
                                style="background-color: #dc3545; height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                            <span class=" mb-2 ml-2"
                                style="background-color: #bc9103; opacity: 0.4;  height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                            <span class=" ml-2 g4"
                                style="background-color: #28a745; height: 50px; width: 50px; border-radius: 50%;">

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class=" text-center text-white">Signal 3</p>
        <div class="ml-5 mt-3 d-flex justify-content-center card text-white bg-dark"
            style="max-height: 80px; max-width: 200px;">
            <div class="card-body">
                <div class="row ">
                    <span class=" mr-2 ml-2 r3"
                        style="background-color: #dc3545; height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                    <span class=" mr-2 "
                        style="background-color: #bc9103; opacity: 0.4;  height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                    <span class="g3" style="background-color: #28a745; height: 50px; width: 50px; border-radius: 50%;">

                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
<iframe name="votar" style="display:none;"></iframe>
<div class="card text-white bg-dark" style="padding-top: 0; max-height: 200px; max-width: 400px;">
    <div class="card-body">
        <form action="signalOverride.php" method="post" target="votar">
            <p class="text-white">Select option to control signals manually</p>
            <div class="row">
                <div class="col-sm-2">
                    <label class="text-white " for="normal">Normal</label>
                    <input type="radio" name="over" value="00" id="norml" checked>
                </div>
                <div class="col-sm-2">
                    <label class="text-white " for="override">Override</label>
                    <input type="radio" name="over" value="10" id="override">
                </div>
                <div class="col-sm-2"></div>
                <input class="btn btn-sm btn-success" type="submit" value="Set">
            </div>
        </form>
        <p>Select Signal which you want to turn on</p>
        <div class="row">
            <div class="col-sm-2">
                <form action="signalOverride.php" method="post" target="votar">
                    <input type="hidden" name="over" value="11">
                    <input class="btn btn-sm btn-success pr-1" type="submit" value="Signal 1">
                </form>
            </div>
            <div class="col-sm-2">
                <form action="signalOverride.php" method="post" target="votar">
                    <input type="hidden" name="over" value="12">
                    <input class="btn btn-sm btn-success pr-1" type="submit" value="Signal 2">
                </form>
            </div>
            <div class="col-sm-2">
                <form action="signalOverride.php" method="post" target="votar">
                    <input type="hidden" name="over" value="13">
                    <input class="btn btn-sm btn-success pr-1" type="submit" value="Signal 3">
                </form>
            </div>
            <div class="col-sm-2">
                <form action="signalOverride.php" method="post" target="votar">
                    <input type="hidden" name="over" value="14">
                    <input class="btn btn-sm btn-success" type="submit" value="Signal 4">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    window.onGreen = "#00dc00";
    window.offGreen = "#0d3f19";
    window.onRed = "#ff0000";
    window.offRed = "#850101";
    setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
}, 3000);
$(document).ready(function() {
    fetch_data();
    setInterval(function() {
        fetch_data();
    }, 1000);

    function fetch_data() {
        var action = "traffic";
        var a_id = "<?php echo $getAid;?>";
        $.ajax({
            url: "client.php",
            method: "POST",
            data: {
                action: action,
                a_id: a_id
            },
            success: function(data) {
                // console.log(data);
                // var idata = parseInt(data,10);
                console.log(data);
                if (data == 0) {
                    // console.log(data);
                    $(".r1").css("background-color", window.onRed);
                    $(".g1").css("background-color",window.offGreen);
                    $(".r2").css("background-color", window.onRed);
                    $(".g2").css("background-color", window.offGreen);
                    $(".r3").css("background-color", window.onRed);
                    $(".g3").css("background-color", window.offGreen);
                    $(".r4").css("background-color", window.onRed);
                    $(".g4").css("background-color", window.offGreen);
                }
                if (data == 1) {
                    // console.log(data);
                    $(".r1").css("background-color", window.offRed);
                    $(".g1").css("background-color", window.onGreen);
                    $(".r2").css("background-color", window.onRed);
                    $(".g2").css("background-color", window.offGreen);
                    $(".r3").css("background-color", window.onRed);
                    $(".g3").css("background-color", window.offGreen);
                    $(".r4").css("background-color", window.onRed);
                    $(".g4").css("background-color", window.offGreen);
                }
                if (data == 2) {
                    // console.log(data);
                    $(".r1").css("background-color", window.onRed);
                    $(".g1").css("background-color", window.offGreen);
                    $(".r2").css("background-color", window.offRed);
                    $(".g2").css("background-color", window.onGreen);
                    $(".r3").css("background-color", window.onRed);
                    $(".g3").css("background-color", window.offGreen);
                    $(".r4").css("background-color", window.onRed);
                    $(".g4").css("background-color", window.offGreen);
                }
                if (data == 3) {
                    // console.log(data);
                    $(".r1").css("background-color", window.onRed);
                    $(".g1").css("background-color", window.offGreen);
                    $(".r2").css("background-color", window.onRed);
                    $(".g2").css("background-color", window.offGreen);
                    $(".r3").css("background-color", window.offRed);
                    $(".g3").css("background-color", window.onGreen);
                    $(".r4").css("background-color", window.onRed);
                    $(".g4").css("background-color", window.offGreen);
                }
                if (data == 4) {
                    // console.log(data);
                    $(".r1").css("background-color", window.onRed);
                    $(".g1").css("background-color", window.offGreen);
                    $(".r2").css("background-color", window.onRed);
                    $(".g2").css("background-color", window.offGreen);
                    $(".r3").css("background-color", window.onRed);
                    $(".g3").css("background-color", window.offGreen);
                    $(".r4").css("background-color", window.offRed);
                    $(".g4").css("background-color", window.onGreen);
                }

            }
        });
    }

});
</script>

<?php
include 'footer.php';
ob_end_flush();
?>