<?php

session_start();


$parameters = explode('/', $_SERVER["REQUEST_URI"]);


if (isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"])) {

    require_once "controller/controller.php";

    $controller = new Controller(array_slice($parameters, 2));

    
    if (false) {

    }
    else {

        $content = "view/book_list.php";

        include "view/home.php";


    }

    
}  
else {

    $content = "view/login.php";

    include "view/home.php";

}

?>




