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
        $startDate = (new DateTime($_SESSION["hotelData"]["startDate"]))->format('Y-m-d');
        $endDate = (new DateTime($_SESSION["hotelData"]["endDate"]))->format('Y-m-d');

        // Set up SQL statement
        $sql = "SELECT r.roomID
        FROM room r
        WHERE r.roomName = ?
        AND NOT EXISTS (
            SELECT 1
            FROM hotel h
            WHERE h.roomType = r.roomID
            AND (
                (h.startDate <= ? AND h.endDate >= ?) OR
                (h.startDate >= ? AND h.endDate <= ?)
            )
        )";

        // Prepare and execute the statement
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$select, $startDate, $endDate, $startDate, $endDate]);
        return $stmt->fetchAll(); //return All data
        // SQL to select the roomID from the room table where the roomName matches the specified $select and there are no bookings that overlap with the specified date range. (line 71-74)
        // SQL to check if other booking overlaps the selected date range, and exclude bookings that fully contain the selected date range. (line 75-79)
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
    }
}
