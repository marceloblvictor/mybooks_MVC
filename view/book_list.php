<?php

$books = $controller->context["books"];

?>

<ul>
    <?php
    
       if(empty($books)) {
         echo "<p> Ainda não há livros cadastrados. </p>";
       }
       
       foreach ($books as $title => $book)  {  

        echo "<br>
              <li>
                <h5>" . $book->get_title() . "</h5>
                <p>Autor: " . $book->get_author() . "</p>
                <p>Descrição: " . $book->get_description() . "</p>
                <a href='books/view/" . $book->get_title() . "'><button class='btn btn-primary'> Ver Mais</button></a>
                <hr class='my-4'>
              </li>";

        }  
      
    ?>

</ul>

