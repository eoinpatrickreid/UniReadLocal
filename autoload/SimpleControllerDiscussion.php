<?php
// Class that provides methods for working with the form data.
// There should be NOTHING in this file except this class definition.
// NB this is the version for the AJAX examples, hence getUserTable() etc.

class SimpleControllerDiscussion {
    private $mapper;

    public function __construct() {
        global $f3;						// needed for $f3->get()
        $this->mapper = new DB\SQL\Mapper($f3->get('DB'),"discussion");	// create DB query mapper object
    }

    public function putIntoDatabase($data) {
        $this->mapper->bookID = $data["bookID"];
        $this->mapper->username = $data["username"];					// set value for "name" field
        $this->mapper->review = $data["review"];
        $this->mapper->likes = $data["likes"];
        // set value for "colour" field
        $this->mapper->save();									// save new record with these fields
    }


    public function getData() {
        $list = $this->mapper->find(null, array('order' => 'likes DESC'));
        // Debugging: Output the number of reviews fetched
        error_log('Number of reviews fetched: ' . count($list));
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


    public function like($username) {
        $this->mapper->load(['username=?', $username]);
        if ($this->mapper->dry()) {
            return "No record found for the title: {$username}";
        } else {
            $this->mapper->likes += 1;
            $this->mapper->save();
            return "Vote updated successfully for the title: {$username}. New vote count: " . $this->mapper->likes;
        }
    }

    public function dislike($username) {
        $this->mapper->load(['username=?', $username]);
        if ($this->mapper->dry()) {
            return "No record found for the title: {$username}";
        } else {
            $this->mapper->likes -= 1;
            $this->mapper->save();
            return "Vote updated successfully for the title: {$username}. New vote count: " . $this->mapper->likes;
        }
    }

}