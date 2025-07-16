<?php

class SimpleControllerThisWeek {
    private $mapper;

    public function __construct() {
        global $f3; // needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'), "thisWeeksBook"); // create DB query mapper object for "books" table
    }

    public function putIntoDatabase($data) {
        // Map all 23 columns from the CSV to the database
        $this->mapper->isbn = $data["isbn"];
        $this->mapper->save(); // save new record with these fields
    }

    public function getAllISBNs() {
        $this->mapper->load(); // load all records
        $isbns = [];
        while (!$this->mapper->dry()) { // while not at the end of the dataset
            $isbns[] = $this->mapper->isbn; // add the isbn to the array
            $this->mapper->next(); // move to the next record
        }
        return $isbns; // return the array of ISBNs
    }

    // Function to remove all entries from the database
    public function removeAllEntries() {
        $this->mapper->erase(); // erase all records
    }

}