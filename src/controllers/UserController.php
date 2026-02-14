<?php

class UserController {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // GET ALL
    public function index() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function store($data) {
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":email", $data['email']);

        return $stmt->execute();
    }

    // UPDATE
    public function update($id, $data) {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // DELETE
    public function destroy($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
