<?php
// Class that provides methods for working with user data.
// This class is designed to interact with a 'users' table in the database.

class SimpleControllerLogin {
    private $mapper;

    public function __construct() {
        global $f3; // needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'), "users"); // create DB query mapper object for 'users' table
    }

    public function addUser($data) {
        $this->mapper->username = $data["username"]; // Set value for "username" field
        $hashed = password_hash($data["password"], PASSWORD_DEFAULT);
        $this->mapper->password = $hashed; // Hash password before saving
        $this->mapper->save(); // Save new record with these fields
    }

    public function getAllUsers() {
        $list = $this->mapper->find();
        return $list;
    }

    public function searchUser($field, $term) {
        $list = $this->mapper->find([$field . " LIKE ?", "%" . $term . "%"]);
        return $list;
    }

    public function deleteUser($idToDelete) {
        $this->mapper->load(['id=?', $idToDelete]); // Load DB record matching the given ID
        $this->mapper->erase(); // Delete the DB record
    }

    // Example method to update user data (e.g., email)

    public function authenticateUser($username, $password) {
        // Attempt to find the user by username
        $this->mapper->load(['username=?', $username]);

        // Check if a user was found and verify the password
        //if (!$this->mapper->dry() && password_verify($password, $this->mapper->password)) {
        if (!$this->mapper->dry() && password_verify($password, $this->mapper->password)){
            // Authentication successful
            return true;
        } else {
            // Authentication failed
            return false;
        }
    }

    // You can add more methods here as needed to handle specific user operations,
    // like authentication, password updates, etc.
}
