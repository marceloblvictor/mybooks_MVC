<?php 

class Book {

    private $title;
    private $author;
    private $description;
    private $id;
    private $user;

    public function __construct($title, $author, $description, $book_id, $user_id) {

        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->id = $book_id;
        $this->user = $user_id;

    }

    public function get_title() {

        return $this->title;

    }

    public function get_author() {

        return $this->author;

    }

    public function get_description() {

        return $this->description;
        
    }

    public function get_id() {

        return $this->id;

    }

    public function get_user() {
        
        return $this->user;
    }

}
?>