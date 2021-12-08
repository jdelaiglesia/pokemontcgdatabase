<?php

class ExpansionsModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=pokemontcgdb;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function getAllExpansions() {
        $query = $this->db->prepare('SELECT * FROM expansions');
        $query->execute();
    
        $expansions = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $expansions;
    }

    function getExpansion($expansion) {
        $query = $this->db->prepare('SELECT * FROM expansions WHERE id = :id');
        $query->execute(['id' => $id]);

        $expansion = $query->fetchAll(PDO::FETCH_OBJ);

        return $expansion;
    }

    function insertCard($name) {
        $query = $this->db->prepare('INSERT INTO expansions (name) VALUES (:name)');
        $query->execute(['name' => $name]);
    }

    function deleteCard($id) {
        $query = $this->db->prepare('DELETE FROM expansions WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    function updateCard($id, $name) {
        $query = $this->db->prepare('UPDATE expansions SET name = :name WHERE id = :id');
        $query->execute(['name' => $name, 'id' => $id]);
    }
}