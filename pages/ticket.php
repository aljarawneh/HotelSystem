<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage Object
$webpage = new Webpage("Ticket - RZA", "ticket");

// Ticket Object
$ticket = new Ticket($_GET["type"] ?? '', $_POST["startDate"] ?? '', $_POST["ticketSelect"] ?? '');

// Don't show notices
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
        <form method="post" class=" needs-validation" novalidate>
            <h3 class="text-center"><?php echo ucfirst($_GET["type"]) ?> Tickets - Confirm Booking Details</h3>
            <div class="row">
                <div class="col-md-6">
                    <!-- Date -->
                    <label for="startDate" class="fs-5 pb-2">Start Date: </label>
                    <div class="input-group mb-3 has-validation">
                        <label class="input-group-text">Date</label>
                        <input type="text" id="startDate" name="startDate" class="form-control <?php if (isset($_POST["dateSubmit"])) $ticket->errorCheck("date") ?>" placeholder=" Select Date.." readonly="readonly" min="today" max="today + 10 days" value="<?php if (isset($_POST["dateSubmit"])) $ticket->returnInput("date") ?>" required />
                        <button type="button" class="btn btn-light input-group-end" id="dateClear">Clear</button>
                        <div class="invalid-feedback">
                            <!-- Invalid input-->
                            Date is empty, please try again.
                        </div>
                    </div>
                    <!-- Picking Ticket Type -->
                    <label for="ticketSelect" class="fs-5 pb-2">Ticket Type: </label>
                    <div class="input-group mb-3 has-validation">
                        <label class="input-group-text" for="ticketSelect">Type</label>
                        <select class="form-select <?php if (isset($_POST["dateSubmit"])) $ticket->errorCheck("select") ?>" id="ticketSelect" name="ticketSelect" required>
                            <?php $ticket->displaySelect() ?>
                        </select>
                        <div class="invalid-feedback">
                            <!-- Invalid input-->
                            Select a ticket type, please try again.
                        </div>
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