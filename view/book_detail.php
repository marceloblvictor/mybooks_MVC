 <?php
 
    $book = $controller->context["book"];

    echo "<h2><b>" . $book->get_title() . "</b></h2>";  
    echo "<h3>Autor: " . $book->get_author() . "</h3>";  
    echo "<h5>Descrição: </h5>";
    echo "<p>" . $book->get_description() . "</p>";
    echo "<hr class='my-4'>";
    echo "<a href='books/" . $book->get_id() . "/edit' style='margin-right: 20px;'><button class='btn btn-info'>Editar</button></a>";
    echo "<a href='books/" . $book->get_id() . "/delete'><button class='btn btn-danger'>Apagar</button></a>";
  
?>  


  
