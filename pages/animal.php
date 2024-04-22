<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage object
$webpage = new Webpage("Animal", "animal");
$webpage->setScript("../scripts/animal.js");

// Animal class
$animal = new Animal($_GET["type"] ?? '');



require_once("../includes/header.inc.php"); ?>

<main>
    <!-- Information -->
    <section class="container my-4" <?php $animal->displaySection("information") ?>>
        <!-- Search -->
        <form method="post">
            <div class="input-group mb-3">
                <!-- Search Bar -->
                <input type="text" placeholder="Search..." class="form-control" id="search" name="search">
                <!-- Search Button -->
                <button class="btn btn-light border" name="searchBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
        </form>
        <!-- Animal -->
        <div class="row gap-3 mx-auto">
            <?php
            if (isset($_POST["searchBtn"])) {
                $animal->validateSearch($_POST["search"]);
            } else {
                $animal->displayAnimals();
            } ?>
        </div>

    </section>

    <!-- Details -->
    <section <?php $animal->displaySection("details") ?>>
        a
    </section>

</main>



<?php require_once("../includes/footer.inc.php"); ?>