<?php

// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

include_once("profile.class.php");

// Class to set data to webpage
class Webpage {
    // Properties
    private $title;
    private $active;
    private $stylesheets;
    private $scripts;

    // Method to assign properties with value
    public function __construct($title, $active) {
        $this->title = $title;
        $this->active = $active;
    }

    // SET Method to assign stylesheets (args)
    public function setStyleSheets($stylesheet) {
        $this->stylesheets = $stylesheet;
    }

    // GET Method to get the active for navbar
    public function getActive($type) {
        if ($this->active == $type) echo "active text-bg-light";
    }

    // Method to return hidden if footer needs to be disabled
    public function disableFooter() {
        if (in_array($this->active, ["account", "profile"])) {
            echo "hidden";
        }
    }

    // GET Method to get the title
    public function getTitle() {
        echo strlen($this->title) <= 0 ? "TEST" : $this->title;
    }

    // SET Method to assign scripts (args)
    public function setScript($script) {
        $this->scripts = $script;
    }

    // Method to get script
    public function getScript() {
        echo strlen($this->scripts) == 0 ? '' : '<script src="' . $this->scripts . '"></script>';
    }

    // Method to display correct section for ticket & hotel
    public function displaySection($type, $section) {
        $types = ["adult", "children", "family", "educational", "single", "double", "deluxe", "family"];
        if (($section == "main" && (in_array($type, $types) || $type == "payment")) ||
            ($section == "booking" && !in_array($type, $types)) ||
            ($section == "payment" && $type != "payment")
        ) {
            echo "hidden";
        }
    }


    // Method to return boolean value if flatpickr scripts need to be included
    public function showFlatpickr() {
        return strpos($_SERVER['PHP_SELF'], "ticket.php") || strpos($_SERVER['PHP_SELF'], "hotel.php") ?  true : false;
    }
}
