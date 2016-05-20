<?php

require_once "Database.php";

class News {

    var $id;
    var $title;
    var $content;
    var $userId;
    var $date;
    var $popularity;
    var $numberVotes;
    var $categoryId;

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function getUserId() {
        return $this->userId;
    }

    function getDate() {
        return $this->date;
    }

    function getPopularity() {
        return $this->popularity;
    }
    
    function getNumberVotes() {
        return $this->numberVotes;
    }
    
    function getCategoryId() {
        return $this->categoryId;
    }
    
    function __construct($id, $title, $content, $userId, $date, $popularity, $numberVotes, $categoryId = null) {
        $this->id          = $id;
        $this->title       = $title;
        $this->content     = $content;
        $this->userId      = $userId;
        $this->date        = $date;
        $this->popularity  = $popularity;
        $this->numberVotes = $numberVotes;
        $this->categoryId  = $categoryId;
    }    
    
    function save() {
        $db = new Database();
        return $db->createNew($this->getTitle(), $this->getContent(), $this->getUserId(), $this->getCategoryId());
    }
    
    function getAllNews($orderProperty = null, $order = null, $search = null) {
        $db = new Database();
        return $db->getAllNews($orderProperty, $order, $search);
    }
    
    function getNew($id) {
        $db = new Database();
        return $db->getNew($id);
    }
    
    function getNewBy($property, $value) {
        $db = new Database();
        return $db->getNewBy($property, $value);
    }
    
    function edit($id, $title, $content, $category) {
        $db = new Database();
        return $db->editNew($id, $title, $content, $category);
    }
    
    function delete() {
        $db = new Database();
        return $db->deleteNew($this->getId());
    }
    
    function votePopularity($popularityNote) {
        $db = new Database();
        $db->newVotePopularity($this->getId(), $popularityNote);
    }
}
