<?php

include_once("model/Model.php");  
      
class Controller {

     public $model;
     private $args;   
  
     public function __construct($args) {    

          $this->model = new Model();
          $this->args = $args;  

     }   
      
     public function invoke() {  
          
          // Checa se o Controller requisitado é dos livros e não há mais nenhum argumento na URL
          if ($args[0] === "books" && count($args) == 1)  {

            // Checa se o usuário está autenticado (IMPLEMENTAR!!!).
            if (true) {
                $books = $this->model->getBookList();  
                include 'view/booklist.php';    
            }

            else {

            }
               
               
          } 
          else 
          { 
               // show the requested book 
               $book = $this->model->getBook($_GET['book']); 
               include 'view/viewbook.php';  
          }  
     }  
}  




?>