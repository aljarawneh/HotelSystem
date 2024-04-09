<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

class Hotel extends Dbh {
    // Properties
    private $startDate;
    private $endDate;
    private $errors = array();

    // Construct Method to assign properties
    public function __construct($startDate, $endDate) {
        // Assign
        $this->startDate = date('Y-m-d', strtotime($startDate));
        $this->endDate = date('Y-m-d', strtotime($endDate));
    }
}
