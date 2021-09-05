<?php
require "predis/autoload.php";
require '../conn.php';
Predis\Autoloader::register();
$redis;
try {
    $redis = new Predis\Client(array(
        "scheme" => "tcp",
        "host" => "192.168.10.5",
        "port" => 6379
    ));
} catch (Exception $e) {
	die($e->getMessage());
}
?>