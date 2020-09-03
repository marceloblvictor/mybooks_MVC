<?php

include_once("model/Model.php");  
      
class Controller {

     public $model;
     private $context;
     private $content;
     private $LAYOUT;
     private $args_url;
  
     public function __construct($request_url) {    

          $this->model = new Model();
          $this->context = array();
          $this->content = "";
          $this->LAYOUT = "view/home.php";
          $this->args_url = array_slice(explode("/", $request_url), 2);

     }   
      
     // Cuida do dispatching da url
     public function dispatch() {

          // Redireciona para o index no caso de logout do usuário.
          if ($this->args_url[0]="books" && in_array("logout.php", $this->args_url)) {

                    header("Location: index.php");

          }


          // Somente usuários autenticados podem adicionar e acessar livros.
          elseif ($this->is_user_authenticated() && $this->args_url[0] = "books") {

               if ($this->args_url[0] === "books" && count($this->args_url) === 1)  {

                    $this->listBooks();
                    $this->render();
                    
               }

               elseif ($this->args_url[0] === "books" && $this->args_url[1] === "create"
                                                      && count($this->args_url) === 2) {

                    $this->createBook();
                    $this->render();

               }
     
               // Somente o usuário correto poderá acessar o view, delete e edit:
               elseif ($this->args_url[0] === "books" && is_numeric($this->args_url[1])
                                                      && $this->model->is_user_the_owner($this->args_url[1], $_SESSION["user_id"])) {
     
                    if (count($this->args_url) == 2) {
                         
                         $this->viewBook($this->args_url[1]);
                         $this->render();
     
                    }
     
                    elseif ($this->args_url[2] == "edit") {
                         $this->editBook($this->args_url[1]);
                         $this->render();
     
                    }

                    elseif ($this->args_url[2] == "delete") {
                         $this->deleteBook($this->args_url[1]);
                         $this->render();
     
                    }
     
               }

               else {

                    header("Location: ../index.php");
               }

          }
                 
          else {

               $this->content = "login.php";
               $this->render();
                
          }
          
     }

     // Renderiza o layout usando os dados armazenados no Controller
     public function render() {

          include $this->LAYOUT;

     }
     
     private function listBooks() {
          
          $this->context["books"] = $this->model->getBookList($_SESSION["user_id"]);
          $this->content = "view/book_list.php";

     }

     private function viewBook($book_id) {

          $this->context["book"] =$this->model->getBook($book_id);
          $this->content = "view/book_detail.php"; 

     }

     private function createBook() {

          $this->content = "view/book_create.php";
     }

     private function deleteBook($book_id) {

          $this->context["book_id"] = $book_id;
          $this->content = "view/book_delete.php";

     }

     // helper methods:

     public function is_user_authenticated() {

          return isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"]) && isset($_SESSION["username"]);

     }

}  




?>