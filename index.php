<?php

require_once "controller/controller.php";
require_once "config.php";

session_start();


$request_url = $_SERVER["REQUEST_URI"];
$controller = new Controller($request_url);

$controller->dispatch();





?>




