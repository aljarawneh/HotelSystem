<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage object
$webpage = new Webpage("Animal", "animal");
$webpage->setScript("../scripts/animal.js");

require_once("../includes/header.inc.php"); ?>

<main></main>

<?php require_once("../includes/footer.inc.php"); ?>