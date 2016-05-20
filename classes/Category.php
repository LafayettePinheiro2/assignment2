<?php

require_once 'Database.php';
require_once 'News.php';

class Category {
    
    var $id;
    var $name;     

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    function getAllCategories() {
        $db = new Database();
        return $db->getAllCategories();
    }
    
    function getCategory($id) {
        $db = new Database();
        return $db->getCategory($id);
    }
    
    function getCategoryByName($name) {
        $db = new Database();
        return $db->getCategoryByName($name);
    }
    
    function getNumberNewsForCategory($id) {
        $db = new Database();
        return $db->getNumberNewsForCategory($id);
    }
    
    function save() {
        $db = new Database();
        return $db->createCategory($this->getName());
    }
    
    function edit($id, $name) {
        $db = new Database();
        return $db->editCategory($id, $name);
    }
    
    function delete() {
        $db = new Database();
        return $db->deleteCategory($this->getId());
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
}