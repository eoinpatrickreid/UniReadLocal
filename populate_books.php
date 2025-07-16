<?php

require_once '/AboveWebRoot/fatfree-master/lib/base.php'; // Adjust this path to where the Fat-Free Framework is located
require_once '/autoload/SimpleControllerBooks.php'; // Ensure this is the path to the SimpleControllerBooks class


$home = '/home/'.get_current_user();
$f3 = require($home.'/AboveWebRoot/fatfree-master/lib/base.php');

$f3 = Base::instance();
$f3->set('DB', new DB\SQL(
    'mysql:host=yourhost;port=3306;dbname=books',
    'bookclub',
    'Clubbook67?'
));

// Function to read the CSV file and insert data into the database
function populateDatabaseFromCSV($filename) {
    global $f3; // Make sure to use the global instance of $f3

    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }

    $controller = new SimpleControllerBooks();

    if (($handle = fopen($filename, 'r')) !== false) {
        $header = fgetcsv($handle); // Assuming the first row contains the header
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            $controller->putIntoDatabase($data);
        }
        fclose($handle);
    }

    return true;
}

// Path to the CSV file
$csvFile = 'books.csv';

// Call the function and check if it was successful
if (populateDatabaseFromCSV($csvFile)) {
    echo "Database populated successfully from {$csvFile}.";
} else {
    echo "Failed to populate the database from {$csvFile}.";
}
