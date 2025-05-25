<?php

class User {
    private $conn;
   
    public function __construct($host, $dbname, $username, $password) {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Error during connection
            $_SESSION['db_error'] = '<div class="alert alert-danger">Connection error: ' . $e->getMessage() . '</div>';
        }
    }

    public function prikaziSve() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user ORDER BY userID DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Error while fetching users
            $_SESSION['db_error'] = '<div class="alert alert-danger">Error fetching users: ' . $e->getMessage() . '</div>';
            return [];
        }
    }

   public function addUser($userName, $gender, $email, $phoneNumber, $address, $about) {
    try {
        $stmt = $this->conn->prepare("INSERT INTO user (`userName`, `gender`, `email`, `phoneNumber`, `address`, `about`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userName, $gender, $email, $phoneNumber, $address, $about]);

        $_SESSION['add'] = '<div class="alert alert-success">User added successfully! 😊</div>';
        return true;
    } catch (PDOException $e) {
        $_SESSION['db_error'] = '<div class="alert alert-danger">Error adding user: ' . $e->getMessage() . '</div>';
        return false;
    }
}

    public function ucitajJednog($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE userID = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Error while loading user
            $_SESSION['db_error'] = '<div class="alert alert-danger">Error loading user: ' . $e->getMessage() . '</div>';
            return null;
        }
    }

    public function urediIgracaBezSlike($userName, $gender, $email , $phoneNumber ,$address, $about, $id) {
        try {
            $stmt = $this->conn->prepare("UPDATE igrac SET userName=?, gender=?, email=?, phoneNumber=?, address=?, about=? WHERE userID=?");
            $stmt->execute([$userName, $gender, $email , $phoneNumber ,$address, $about , $id]);

            // Player successfully updated
            $_SESSION['add'] = '<div class="alert alert-success">Player updated successfully 😊</div>';
            return true;
        } catch (PDOException $e) {
            // Error while updating player
            $_SESSION['db_error'] = '<div class="alert alert-danger">Error updating player: ' . $e->getMessage() . '</div>';
            return false;
        }
    }

    public function deleteUser($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM user WHERE userID = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // User successfully deleted
                $_SESSION['add'] = '<div class="alert alert-success">User deleted successfully 😊</div>';
                return true;
            } else {
                // User not found
                $_SESSION['db_error'] = '<div class="alert alert-warning">User not found 😒</div>';
                return false;
            }
        } catch (PDOException $e) {
            // Error while deleting user
            $_SESSION['db_error'] = '<div class="alert alert-danger">Error deleting user: ' . $e->getMessage() . '</div>';
            return false;
        }
    }

}
