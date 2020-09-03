<?php

require_once "controller/controller.php";

session_start();

$request_url = $_SERVER["REQUEST_URI"];
$controller = new Controller($request_url);

$content = $controller->dispatch();
$controller->render();


?>




