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

    function createBook($title, $author, $description, $user_id) {

        require_once "config.php";
        
        global $pdo;
        $sql = "INSERT INTO book (title, author, description, user) VALUES (:title, :author, :description, :user_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title); 
        $stmt->bindValue(':author', $author); 
        $stmt->bindValue(':description', $description); 
        $stmt->bindValue(':user_id', $user_id); 

        return $stmt->execute();
    }

    function editBook($title, $author, $description, $book_id) {

        require_once "config.php";
        
        global $pdo;
        $sql = "UPDATE book SET title = :title, author = :author, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title); 
        $stmt->bindValue(':author', $author); 
        $stmt->bindValue(':description', $description); 
        $stmt->bindValue(':book_id', $id_id); 

        return $stmt->execute();
    }

    function deleteBook($book_id) {

        require_once "config.php";
        global $pdo;

        $sql = "DELETE * FROM book WHERE id = :book_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':book_id', $book_id); 

        return $stmt->execute();
    }

    // Checa se o usuário autenticado é dono do livro requisitado
    public function is_user_the_owner($book_id, $user_id) {

        $book = $this->getBook($book_id);

        return $book->get_user() === $user_id;
        

    }
          
} 
?>