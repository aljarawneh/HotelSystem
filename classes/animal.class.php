<?php

// Includes
include_once("dbh.class.php");

// Class for Animal page
class Animal extends Dbh {
    // Properties
    private $type;
    private $animals;

    // Constructor to assign values
    public function __construct($type) {
        $this->type = ucfirst($type);
        $this->animals = $this->animalList();
    }

    // Method to return list of all animal in the database
    private function animalList() {
        $stmt = $this->connect()->prepare("SELECT animalName FROM animals");
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Method to validate search
    public function validateSearch($search) {
        if (strlen($search) > 0 && ctype_alpha($search)) {
            $result = $this->searchLike($search);

            if (count($result) !== 0) {
                $this->displaySearchedAnimals($result);
            } else {
                echo "
                <div class='alert alert-danger' role='alert'>
                    <strong>Invalid Search!</strong> We don't have the animal <strong>'" . $search . "'</strong> in our zoo.
                </div>
                ";
            }
        } else {
            $this->displayAnimals();
        }
    }

    // Method to return result of a search
    private function searchLike($search) {
        $stmt = $this->connect()->prepare("SELECT animalName FROM animals WHERE animalName LIKE ?");
        $stmt->execute(["%" . $search . "%"]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Method to display cards of all animals
    public function displayAnimals() {
        foreach ($this->animals as $key => $value) {
            echo
            '
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../images/logo-light.png" alt="Title" />
                <div class="card-footer mt-2 ">
                    <div class="d-flex justify-content-between">
                        <p class="my-auto">' . $value . '</p>
                        <a href="?type=' . lcfirst($value) . '" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            ';
        }
    }

    // Method to display cards of searched animals
    public function displaySearchedAnimals($animals) {
        foreach ($animals as $key => $value) {
            echo
            '
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="../images/logo-light.png" alt="Title" />
                <div class="card-footer mt-2 ">
                    <div class="d-flex justify-content-between">
                        <p class="my-auto">' . $value . '</p>
                        <a href="?type=' . lcfirst($value) . '" class="btn btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
            ';
        }
    }

    // Method to return hidden for sections
    public function displaySection($section) {
        if (isset($_GET["type"]) && in_array($this->type, $this->animals)) {
            echo $section == "details" ? "" : "hidden";
        } else {
            echo $section == "details" ? "hidden" : "";
        }
    }
}
