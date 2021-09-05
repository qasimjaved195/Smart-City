<?php
include 'redisconn.php';
$override = $_POST["over"];
$redis->set("t0",$override);
echo $override;
?>