<?php

class SimpleControllerBooks {
    private $mapper;

    public function __construct() {
        global $f3; // needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'), "google_2"); // create DB query mapper object for "books" table
    }
    public function findAll() {
        return $this->mapper->find();
    }
    

    public function putIntoDatabase($data) {
        // Map all 23 columns from the CSV to the database
        $this->mapper->id = $data["id"];
        $this->mapper->title = $data["title"];
        $this->mapper->isbn = $data["ISBN"];
        $this->mapper->haveRead = $data["haveRead"];
        $this->mapper->save(); // save new record with these fields
    }
    // Add function to read all rows where haveRead == 1
    public function findRead() {
        $this->mapper->load(['haveRead=?', 1]);
        $readBooks = [];
        while (!$this->mapper->dry()) { // while not at the end of the dataset
            $readBooks[] = $this->mapper->cast(); // cast current row to an array
            $this->mapper->next(); // move to next record
        }
        return $readBooks; // return array of books that have been read
    }

    // Function to update haveRead to 1 for a given ISBN
    public function markAsRead($isbn) {
        $this->mapper->load(['isbn=?', $isbn]); // find the book by ISBN
        if (!$this->mapper->dry()) { // check if the book exists
            $this->mapper->haveRead = 1; // set haveRead to 1
            $this->mapper->save(); // save the change
        }
    }
}
