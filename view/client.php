<?php
include 'redisconn.php';

if($_POST["action"] == "fetch_data")
{
    $result = $redis->get('msg');
    echo $result;
}
if($_POST["action"] == "waterData")
{
    $aid = $_POST['a_id'];
    $getV = "select * from mvariables where a_id='$aid'";
    $getVR = $conn->query($getV);
    $vrs = array();
    while ($row = mysqli_fetch_assoc($getVR))
    {
        $recValue = $redis->get($row['mv_name']);
        $full = (int)$row['min'];
        $empty = (int)$row['max'];
        $dif = $full - $empty;
        $multip = (int)100/$dif;
        $show = ($full-$recValue)*$multip;
        if ($show > 100) {
            $show = 100;
        }
        if ($show <0) {
            $show = 0;
        }
        $vrs += array($row['mv_name'] => (int)$show);
        // array_push($vrs, $redis->get($row['mv_name']));
    }
    echo json_encode($vrs);
    // print_r($vrs);
}
if($_POST["action"] == "binData")
{
    $aid = $_POST['a_id'];
    $getV = "select * from mvariables where a_id='$aid'";
    $getVR = $conn->query($getV);
    $vrs = array();
    while ($row = mysqli_fetch_assoc($getVR))
    {
        $recValue = $redis->get($row['mv_name']);
        $full = (int)$row['min'];
        $empty = (int)$row['max'];
        
        $dif = $full - $empty;
        $multip = (int)100/$dif;
        $show = ($full-$recValue)*$multip;
        if ($show > 100) {
            $show = 100;
        }
        if ($show <0) {
            $show = 0;
        }
        $vrs += array($row['mv_name'] => (int)$show);
        // array_push($vrs, $redis->get($row['mv_name']));
    }
    echo json_encode($vrs);
    // print_r($vrs);
}
if($_POST["action"] == "canalData")
{
    $aid = $_POST['a_id'];
    $getV = "select * from mvariables where a_id='$aid'";
    $getVR = $conn->query($getV);
    $vrs = array();
    while ($row = mysqli_fetch_assoc($getVR))
    {
        $recValue = $redis->get($row['mv_name']);
        
        $full = (int)$row['min'];
        $empty = (int)$row['max'];
        if ($recValue > $empty) {
            $recValue = $empty;
        }
        if ($recValue < $full) {
            $recValue = $full;
        }
        $dif = $full - $empty;
        $multip = (int)100/$dif;
        $show = ($full-$recValue)*$multip;
        
        $vrs += array($row['mv_name'] => (int)$show);
        // array_push($vrs, $redis->get($row['mv_name']));
    }
    echo json_encode($vrs);
    // print_r($vrs);
}
if($_POST["action"] == "parking")
{
    $aid = $_POST['a_id'];
    $getV = "select * from mvariables where a_id='$aid'";
    $getVR = $conn->query($getV);
    $vrs = array();
    while ($row = mysqli_fetch_assoc($getVR))
    {

        $vrs += array($row['mv_name'] => $redis->get($row['mv_name']));
        // array_push($vrs, $redis->get($row['mv_name']));
    }
    echo json_encode($vrs);
    // print_r($vrs);
}
if($_POST["action"] == "traffic")
{
    $aid = $_POST['a_id'];
    $getV = "select * from mvariables where a_id='$aid' LIMIT 1";
    $getVR = $conn->query($getV);
    $getRow = mysqli_fetch_assoc($getVR);
    $cars = array();
    $a =1;
    $result = $redis->get($getRow['mv_name']);
    echo $result;
    // echo $result;
}
// // gets the value of message
// $value = $redis->get('message');

// // Hello world
// echo ($value);
?>