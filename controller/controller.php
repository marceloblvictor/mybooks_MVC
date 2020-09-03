<?php

include_once("model/Model.php");  
      
class Controller {

     public $model;
     private $context;
     private $content;
     private $layout;
     private $request_url;
     private $args_url;
  
     public function __construct($request_url) {    

          $this->model = new Model();
          $this->context = array();
          $this->content = "";
          $this->layout = "view/home.php";
          $this->args_url = array_slice(explode("/", $request_url), 2);

     }   
      
     // Cuida do dispatching da url
     public function dispatch() {
          
          if ($this->args_url[0] === "books" && count($this->args_url) === 1)  {

               $this->showBooks();  
               
          }

          elseif ($this->args_url[0] === "books" && is_numeric($this->args_url[1])) {

               if (count($this->args_url) == 2) {
                    echo "mostrando livro especifico!!!!";
                    $this->showSpecificBook();

               }

               

          }
                
               
          else {

               $this->showBooks();
                
          }
          
     }

     // Renderiza o layout usando os dados armazenados aqui no Controller
     public function render() {

          include $this->layout;

     }
     
     private function showBooks() {
          if ($this->is_user_authenticated()) {

               $this->context["books"] = $this->model->getBookList($_SESSION["user_id"]);
               $this->content = "view/book_list.php";
               
          }

          else {

               $this->content = "view/login.php";

          }

     }

     private function showSpecificBook() {

          $this->content = "view/book_detail.php"; 
          $book = $this->model->getBook($this->args_url[1]);
          array_push($this->context);

     }

     public function is_user_authenticated() {

          return isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"]) && isset($_SESSION["username"]);

     }

     
}  




?>