<?php
include_once "model/Book.php";
include_once "model/User.php";




class Model {

    public function get_BookList($user_id) {

        $result = array();

        require_once "config.php";       
        
        $sql = "SELECT title, author, description FROM book WHERE user = :user_id";        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);   
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            $result[$row["title"]] = new Book($row["title"], $row["author"], $row["description"]);

        }
         
        return $result;
    }  

    public function get_Book($title) {
        
          

        return $all_users[$title];  
    }

    public function get_UserList() {

        
        
        return array(
            "joao" => new User("joao", "secret", "20/02 12:30:12"),
            "maria" => new User("maria", "secret2", "10/05 01:20:46"),
        );
    }

    public function get_User($username) {  
        
        $all_users = $this->getUserList();  

        return $all_users[$username];  
    }


          
} 
?>