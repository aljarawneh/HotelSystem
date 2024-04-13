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
}
