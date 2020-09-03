<?php

    $controller->model->deleteBook($controller->context["book_id"]);

    header("Location: index.php");

?>