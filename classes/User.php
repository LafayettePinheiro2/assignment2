<?php

require_once 'Database.php';

class User {
    
    var $id;
    var $name;
    var $surname;
    var $password;
    var $email;      
    var $isAdmin;           

    function __construct($id, $name, $surname, $password, $email, $isAdmin) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }
    
    function save() {
        $db = new Database();
        return $db->createUser($this->getName(), $this->getSurname(), $this->getPassword(), $this->getEmail());
    }
    
    function edit($id, $name, $surname, $password) {
        $db = new Database();
        return $db->editUser($id, $name, $surname, $password);
    }
    
    function delete() {
        $db = new Database();
        return $db->deleteUser($this->getId());
    }
    
    function setUserAsAdmin() {
        $db = new Database();
        return $db->setUserAsAdmin($this->getId());
    }
    
    function userExists() {
        $db = new Database();
        return $db->checkUserExists($this->getEmail());
    }
    
    function checkPassword($email, $password) {
        $db = new Database();
        return $db->checkPassword($email, $password);
    }
    
    function getUserBy($property, $value) {
        $db = new Database();
        return $db->getUserBy($property, $value);
    }
    
    function getAllUsers() {
        $db = new Database();
        return $db->getAllUsers();
    }    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function getSurname() {
        return $this->surname;
    }
    
    function setSurname($surname) {
        $this->surname = $surname;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getIsAdmin() {
        return $this->isAdmin;
    }
}