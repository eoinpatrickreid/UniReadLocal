<?php
// Class that provides methods for working with the form data.
// There should be NOTHING in this file except this class definition.
// NB this is the version for the AJAX examples, hence getUserTable() etc.

class SimpleControllerNextBook {
    private $mapper;

    public function __construct() {
        global $f3;						// needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'),"nextBooks");	// create DB query mapper object
    }

    public function putIntoDatabase($data) {
        $this->mapper->title = $data["title"];
        $this->mapper->isbn = $data["isbn"];
        $this->mapper->votes = $data["votes"];
        $this->mapper->URL = $data["URL"];
        // set value for "colour" field
        $this->mapper->save();									// save new record with these fields
    }


    public function getData() {
        $list = $this->mapper->find(null, array('order' => 'votes DESC'));
        return $list;
    }
    public function search($field, $term) {
        $list = $this->mapper->find([$field . " LIKE ?", "%" . $term . "%"]);
        return $list;
    }

    public function deleteHandler($idToDelete) {
        $this->mapper->load(['id=?', $idToDelete]);				// load DB record matching the given ID
        $this->mapper->erase();									// delete the DB record
    }


    public function getVotesForTitle($title) {
        // Load the record matching the given title
        $this->mapper->load(['title=?', $title]);

        // Check if a record is found
        if ($this->mapper->dry()) {
            // No record found for the given title
            return "No record found for the title: {$title}";
        } else {
            // Record found, return the number of votes
            return $this->mapper->votes;
        }
    }

    public function voteForTitle($title) {
        // Attempt to load the record with the given title
        $this->mapper->load(['title=?', $title]);
        if ($this->mapper->dry()) {
            return "No record found for the title: {$title}";
        }

        try {
            $this->mapper->votes += 1;
            $this->mapper->save();
            return "Vote updated successfully for the title: {$title}. New vote count: " . $this->mapper->votes;
        } catch (Exception $e) {

            return "Error updating vote: " . $e->getMessage();
        }
    }

    public function voteFor($title) {
        $this->mapper->load(['title=?', $title]);
        if ($this->mapper->dry()) {
            return "No record found for the title: {$title}";
        } else {

            $this->mapper->votes += 1;


            $this->mapper->save();

            return "Vote updated successfully for the title: {$title}. New vote count: " . $this->mapper->votes;
        }
    }
    public function voteForTitle2($title) {

        $this->mapper->load(['title=?', $title]);

        if ($this->mapper->dry()) {
            return "No record found for the title: {$title}";
        } else {

            $this->mapper->votes += 1;


            $this->mapper->save();

            return "Vote updated successfully for the title: {$title}. New vote count: " . $this->mapper->votes;
        }
    }

}


