<?php
include_once "model/Book.php";


class Model {

    public function getBookList($user_id) {

        $result = array();

        require_once "config.php";  
        
        global $pdo;
        
        $sql = "SELECT id, title, author, description, user FROM book WHERE user = :user_id";        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);   
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $result[$row["title"]] = new Book($row["title"], $row["author"], $row["description"], $row["id"], $row["user"]);

        }
         
        return $result;
    } 

    // Obtém um livro do banco de dados com o id;
    public function getBook($book_id) {
        
        require_once "config.php";
        
        global $pdo;
        
        $sql = "SELECT id, title, author, description, user FROM book WHERE id = :id";        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $book_id);   
        $stmt->execute(); 

        $row = $stmt->fetch();

        $result = new Book($row["title"], $row["author"], $row["description"], $row["id"], $row["user"]);

        return $result;


    }

    // Checa se o usuário autenticado é dono do livro requisitado
    public function is_user_the_owner($book_id, $user_id) {

        $book = $this->getBook($book_id);

        return $book->get_user() === $user_id;
        

    }
          
} 
?>