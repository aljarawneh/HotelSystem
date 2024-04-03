<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    // Define possible directories
    $directories = ["classes/", "../classes/"];

    // Define file extension
    $extension = ".class.php";

    foreach ($directories as $directory) {
        $fullPath = $directory . $className . $extension;

        if (file_exists($fullPath)) {
            require_once $fullPath;
            return true;
        }
    }
    // Close autoload
    return false;
}
