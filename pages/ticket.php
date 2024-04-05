<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage Object
$webpage = new Webpage("Ticket - RZA", "ticket");

// Ticket Object
$ticket = new Ticket($_GET["type"] ?? '');

// Don't short warning
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once("../includes/header.inc.php"); ?>

<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Tickets</h1>
    <hr class="border border-light border-2 opacity-50 rounded">

    <section id="main" <?php $webpage->displaySection($_GET["type"] ?? '', "main") ?>>
        <div class="row">
            <?php $ticket->displayCards(); ?>
        </div>
    </section>

    <section id="payment" <?php $webpage->displaySection($_GET["type"] ?? '', "payment") ?>>
        <!-- Ticket Booking -->
        <form method="post">
            <h3 class="text-center"><?php echo ucfirst($_GET["type"]) ?> Tickets - Confirm Booking Details</h3>
            <div class="row">
                <div class="col-md-6">
                    <!-- Date -->
                    <label for="startDate" class="fs-5">Start Date: </label>
                    <div class="input-group mb-3">
                        <label class="input-group-text">Date</label>
                        <input type="text" id="startDate" name="startDate" class="form-control" placeholder=" Select Date.." readonly="readonly" min="today" max="today + 10 days" required />
                        <button type="button" class="btn btn-light input-group-end" id="dateClear">Clear</button>
                    </div>
                    <!-- Picking Ticket Type -->
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Type</label>
                        <select class="form-select" id="inputGroupSelect01" required>
                            <option selected disabled>Choose...</option>
                            <?php $ticket->displaySelect() ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <span for="startDate" class="fs-5">Prices: </span>
                        <?php $ticket->displayOptions(); ?>
                    </div>
                </div>
            </div>
            <!-- Submit -->
            <button type="submit" class="btn btn-success" name="dateSubmit">Submit</button>
        </form>
    </section>

</main>

<?php require_once("../includes/footer.inc.php"); ?>