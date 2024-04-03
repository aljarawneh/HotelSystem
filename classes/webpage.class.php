<?php

// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Class to set data to webpage
class Webpage {
    // Properties
    private $title;
    private $active;
    private $stylesheets = [];
    private $scripts = [];

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
        echo strlen($this->title) <= 0 ? "RZA" : $this->title;
    }

    // SET Method to assign scripts (args)
    public function setScripts($script) {
        $this->scripts = $script;
    }
}
