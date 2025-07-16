<?php

class SimpleControllerPersonalLibrary {
    private $mapper;

    public function __construct() {
        global $f3; // needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'), "personalLibrary"); // create DB query mapper object for "books" table
    }

    public function putIntoDatabase($data) {
        // Map all 23 columns from the CSV to the database
        $this->mapper->id = $data["id"];
        $this->mapper->ISBN = $data["ISBN"];
        $this->mapper->username = $data["username"];
        $this->mapper->favourite = $data["favourite"];
        $this->mapper->save(); // save new record with these fields
    }


    public function findUserRead($user) {

        $this->mapper->load(['username=?', $user]);
        $readBooks = [];
        while (!$this->mapper->dry()) { // while not at the end of the dataset
            $readBooks[] = $this->mapper->cast(); // cast current row to an array
            $this->mapper->next(); // move to next record
        }

        return $readBooks; // return array of books that have been read
    }
    // Add function to read all rows where haveRead == 1
    public function findFavourites($user) {
        $this->mapper->load(['username=? AND favourite=?', $user, 1]);
        $readBooks = [];
        while (!$this->mapper->dry()) { // while not at the end of the dataset
            $readBooks[] = $this->mapper->cast(); // cast current row to an array
            $this->mapper->next(); // move to next record
        }
        return $readBooks; // return array of books that have been read
    }

    // Function to update haveRead to 1 for a given ISBN
    public function markAsFavourite($user, $isbn) {
        $this->mapper->load(['username=? AND ISBN=?', $user, $isbn]);
        if ($this->mapper->dry()) {
            error_log("Book with ISBN $isbn for user $user not found.");
        } else {
            $this->mapper->favourite = 1;
            $this->mapper->save();
            error_log("Book with ISBN $isbn for user $user marked as favourite.");
        }
    }
}
