<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Start Sesssion
session_start();

// Include
include_once("dbh.class.php");

class Hotel extends Dbh {
    // Properties
    private $values;
    private $errors = array();

    // Construct Method to assign properties
    public function __construct($startDate, $endDate, $select) {
        // Assign
        $this->values = [
            "startDate" => $startDate,
            "endDate" => $endDate,
            "select" => $select,
        ];

        // echo (new DateTime($this->startDate) >= new DateTime('today'))  ? 'true' : 'false';
        // echo (new DateTime($this->endDate) <= (new DateTime())->modify('+1 month')) ? 'true' : 'false';
    }

    // ----------------------------------------------- Validation methods -----------------------------------------------

    // Method to validate range and booking type
    public function validateFilter() {
        // Run validation
        $this->validateDate($this->values["startDate"], $this->values["endDate"]);
        $this->validateSelect($this->values["select"]);

        if (empty($this->errors)) {
            header("location:?type=" . $this->values['select']);
            $_SESSION["hotelData"] = $this->values;
            exit();
        }
    }

    // Method to Validate Date
    private function validateDate($start, $end) {
        if (strlen($start)  == 0 || strlen($end) == 0) {
            array_push($this->errors, "date");
        }
    }

    // Method to Validate Date
    private function validateSelect($select) {
        if (strlen($select) == 0) {
            array_push($this->errors, "select");
        }
    }

    // ----------------------------------------------- Algorithm methods -----------------------------------------------

    // Method to get all available from db
    private function fetchAvailable() {
        // Set Up variables
        $select = ucfirst($_SESSION["hotelData"]["select"]);

        // Set up SQL statement
        $sql =
            "SELECT h.*
            FROM hotel h
            JOIN room r ON h.roomType = r.roomID
            WHERE r.roomName = ?";

        // Prepare and execute the statement
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$select]);
        return $stmt->fetchAll(); //return All data
        // SQL to select all hotel data where Room and Hotel are joined on (Hotel) roomType & (Room) roomID where room name is $select.  (line 80-83)
    }

    // Method to return dates where each room will be free
    private function returnAvailable($data) {
        // Variables
        $startDate = (new DateTime($_SESSION["hotelData"]["startDate"]))->format('Y-m-d');
        $endDate = (new DateTime($_SESSION["hotelData"]["endDate"]))->format('Y-m-d');
    }

    // ----------------------------------------------- Other methods -----------------------------------------------

    // Method to get validation class
    public function getValid($type) {
        echo in_array($type, $this->errors) ? "is-invalid" : "is-valid";
    }

    // Method to return value
    public function getValue($type) {
        $values = $this->values;
        if ($type == "startDate") {
            echo $this->values[$type];
        } elseif ($type == "endDate") {
            echo $this->values[$type];
        } elseif ($type == $this->values["select"]) {
            echo "selected";
        }
    }

    // Method to display all available date
    public function displayAvailable() {
        print_r($data = $this->fetchAvailable());
        $this->returnAvailable($data);
    }
}
