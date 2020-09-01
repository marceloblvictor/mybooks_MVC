<?php

class User {

    private $username;
    private $password;
    private $registration_date;

    public function __construct($username, $password, $registration_date) {

        $this->username = $username;
        $this->password = $password;
        $this->registration_date = $registration_date;

    }

}


?>