<?php

require_once "User.php";
require_once "News.php";
require_once "Category.php";

class Database {
    
    function connect(){  
        
//        $configs = include('settings/config.php');
        
        try {
//            $conn = new PDO("mysql:host={$configs['hostname']};dbname={$configs['dbname']}", $configs['username'], $configs['pass']);
            $conn = new PDO("mysql:host=localhost;dbname=assignment2", 'root', 'L@fa3856479');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }        
    }
    
    function closeDatabaseConnection(&$link){
        $link = null;
    }
    
    
    //USER FUNCTIONS ON DATABASE
    
    function createUser($name, $surname, $password, $email) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('INSERT INTO user (name, surname, password, email, is_admin) VALUES(:name, :surname, :password, :email, 0)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $return  = $stmt->execute();
        $this->closeDatabaseConnection($conn);
        return $return;
    }
    
    function editUser($id, $name, $surname, $password) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('UPDATE user SET name = :name, surname = :surname, password = :password WHERE id = :id');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function setUserAsAdmin($id) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('UPDATE user SET is_admin = 1 WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function deleteUser($id) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('DELETE FROM user WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }   
    
    
    function getAllUsers() {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT * FROM user');
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        }
        $return = array();
        while($row = $stmt->fetch()) {
            $return[] = new User($row['id'], $row['name'], $row['surname'], $row['password'], $row['email'], $row['is_admin']);
        }
        return $return;
    }
    
    function getUserBy($property, $value) {
        $query = "SELECT * FROM user WHERE {$property} = :value";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $row = $stmt->fetch(); 
        if ($row == false || count($row) == 0) {
            return false;
        } else {
            return new User($row['id'], $row['name'], $row['surname'], $row['password'], $row['email'], $row['is_admin']);
        }
    }
    
    function checkUserExists($email) {
        $conn = $this->connect(); 
        $stmt = $conn->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return (($stmt->rowCount()) > 0 ? true : false);
    }
    
    function checkPassword($email, $inputPassword) {
        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('SELECT password FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        $savedPassword = $row['password'];
        
        if (hash_equals($savedPassword, crypt($inputPassword, $savedPassword))) {
            return true;
        }
        
        return false;
    }
    
    //END USER FUNCTIONS
    //------------------------------------------------------------------------
    
    
    
    
    //NEWS FUNCTIONS ON DATABASE
    
    function createNew($title, $content, $userId, $categoryId = null) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('INSERT INTO news (title, content, user_id, date, popularity, number_votes, category_id) VALUES(:title, :content, :user_id, NOW(), 0, 0, :category_id)');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':category_id', $categoryId);
        return $stmt->execute();
    }
    
    function getAllNews($orderProperty = null, $order = null, $search = null) {
        $conn = $this->connect();
        
        $query = 'SELECT * FROM news';
        
        if($search){
            $query .= " WHERE title LIKE ?";
            $query .= " AND content LIKE ?";
        }
        
        if($orderProperty){
            if($orderProperty == 'popularity'){
                $query .= ' ORDER BY popularity/number_votes';
            } else {                
                $query .= ' ORDER BY '.$orderProperty;
            }
        }
        
        if($order){
            $query .= ' '.$order; 
        }
        
        $stmt = $conn->prepare($query);
        if($search){
            $stmt->bindValue(1, "%$search%", PDO::PARAM_STR);
            $stmt->bindValue(2, "%$search%", PDO::PARAM_STR);
        }
        $stmt->execute();
        $return = array();
        while($row = $stmt->fetch()) {
            $return[] = new News($row['id'], $row['title'], $row['content'], $row['userId'], $row['date'], $row['popularity'], $row['number_votes'], $row['category_id']);

        }
        return $return;
    }
    
    function getNew($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT * FROM news where id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row == false || count($row) == 0) {
            return false;
        } else {
            return new News($row['id'], $row['title'], $row['content'], $row['user_id'], $row['date'], $row['popularity'], $row['number_votes'], $row['category_id']);
        }        
    }
    
    function getNewBy($property, $value) {        
        $query = "SELECT * FROM news WHERE {$property} = :value";
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $row = $stmt->fetch(); 
        if ($row == false || count($row) == 0) {
            return false;
        } else {
            return new News($row['id'], $row['title'], $row['content'], $row['user-id'], $row['date'], $row['popularity'], $row['number_votes'], $row['category_id']);
        }
    }
    
    function editNew($id, $title, $content, $category) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('UPDATE news SET title = :title, content = :content, category_id = :category_id WHERE id = :id');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category_id', $category);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function newVotePopularity($id, $popularityNote) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('UPDATE news SET popularity = popularity + :popularity_vote, number_votes = number_votes + 1 WHERE id = :id');
        $stmt->bindParam(':popularity_vote', $popularityNote);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function deleteNew($id) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('DELETE FROM news WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    
    //END NEWS FUNCTIONS
    //--------------------------------------------------------------------------------------
    
    
    
    
    //CATEGORIES FUNCTIONS ON DATABASE
    
    function getAllCategories() {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT * FROM category');
        $stmt->execute();
        if($stmt->rowCount() == 0){
            return false;
        }
        $return = array();
        while($row = $stmt->fetch()) {
            $return[] = new Category($row['id'], $row['name']);
        }
        return $return;
    }
    
    function createCategory($name) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('INSERT INTO category (name) VALUES(:name)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    function editCategory($id, $name) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('UPDATE category SET name = :name WHERE id = :id');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function deleteCategory($id) {        
        $conn = $this->connect(); 
        $stmt = $conn->prepare('DELETE FROM category WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    function getCategory($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT * FROM category where id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row == false || count($row) == 0) {
            return false;
        } else {
            return new Category($row['id'], $row['name']);
        }        
    }
    
    function getCategoryByName($name) {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT * FROM category where name = :name');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row == false || count($row) == 0) {
            return false;
        } else {
            return new Category($row['id'], $row['name']);
        }        
    }
    
    function getNumberNewsForCategory($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare('SELECT COUNT(id) FROM news where category_id = :category_id');
        $stmt->bindParam(':category_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row[0]; 
    }
    
    
    //END CATEGORIES FUNCTIONS
    //--------------------------------------------
}