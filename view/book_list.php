<?php

$books = $controller->context["books"];

?>

<a href="books/create" class='new-book-btn'><button class="btn btn-success">NOVO LIVRO</button></a>
<hr class="my-4">
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
                <a href='books/" . $book->get_id() . "'><button class='btn btn-primary'> Ver Mais</button></a>
                <hr class='my-4'>
              </li>";

        }
    ?>

    

</ul>

