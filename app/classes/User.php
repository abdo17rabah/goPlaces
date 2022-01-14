<?php

class User {
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $role;

    public function __construct(String $firstName,String $lastName,String $email,String $password,String $role) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getFirstName() : String {
        return $this->firstName;
    }

    public function setFirstName(String $firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() : String {
        return $this->lastName;
    }

    public function setLastName(String $lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() : String {
        return $this->email;
    }

    public function setEmail(String $email) {
        $this->email = $email;
    }

    public function getPassword() : String {
        return $this->password;
    }

    public function setPassword(String $password) {
        $this->password = $password;
    }

    public function getRole() : String {
        return $this->role;
    }

    public function setRole(String $role) {
        $this->role = $role;
    }
}