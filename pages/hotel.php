<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage object
$webpage = new Webpage("Hotel ", "hotel");

// Hotel Object
$hotel = new Hotel($_POST["startDate"] ?? '', $_POST["endDate"] ?? '', $_POST["ticketSelect"] ?? '');

// Validate if date submit pressed
if (isset($_POST["dateSubmit"])) {
    $hotel->validateFilter();
}

require_once("../includes/header.inc.php"); ?>


<main class="container text-white my-2">

    <h1 class="text-white fw-bold text-center">Hotel</h1>
    <hr class="border border-light border-2 opacity-50 rounded">

    <section id="main" <?php $webpage->displaySection($_GET["type"] ?? '', "main") ?>>
        <!-- Filtering date -->
        <form method="post" class="col-md-6 mx-auto needs-validation">
            <h3 class="text-center"></h3><br>
            <!-- Date-->
            <span class="fs-5 pb-2 user-select-none">Select Booking Range </span>
            <div class="input-group mb-3 has-validation">
                <label class="input-group-text">Date</label>
                <input type="text" class="form-control <?php if (isset($_POST["dateSubmit"])) $hotel->getValid("date") ?>" value="<?php if (isset($_POST["dateSubmit"])) $hotel->getValue("startDate") ?>" id="dateRange1" name="startDate" placeholder="Start Date" readonly="readonly" min="today" max="today-30 days + 10 days" required />
                <input type="text" class="form-control <?php if (isset($_POST["dateSubmit"])) $hotel->getValid("date") ?>" value="<?php if (isset($_POST["dateSubmit"])) $hotel->getValue("endDate") ?>" id="dateRange2" name="endDate" placeholder="End Date" readonly="readonly" min="today" max="today + 10 days" required />
                <button type="button" class="btn btn-light input-group-end" id="dateClear">Clear</button>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Date is empty, please try again.
                </div>
            </div>
            <!-- Room type -->
            <span class="fs-5 pb-2 user-select-none">Room Type: </span>
            <div class="input-group mb-3 has-validation">
                <label class="input-group-text" for="ticketSelect">Type</label>
                <select class="form-select <?php if (isset($_POST["dateSubmit"])) $hotel->getValid("select") ?>" id="ticketSelect" name="ticketSelect">
                    <option selected disabled>Select..</option>
                    <option <?php if (isset($_POST["dateSubmit"])) $hotel->getValue("single") ?> value="single">Single Room</option>
                    <option <?php if (isset($_POST["dateSubmit"])) $hotel->getValue("double") ?> value="double">Double Room</option>
                    <option <?php if (isset($_POST["dateSubmit"])) $hotel->getValue("deluxe") ?> value="deluxe">Deluxe Room</option>
                    <option <?php if (isset($_POST["dateSubmit"])) $hotel->getValue("family") ?> value="family">Family Room</option>
                </select>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Select a room type, please try again.
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="dateSubmit">Submit</button>
        </form>
    </section>

    <section id="booking" <?php $webpage->displaySection($_GET["type"] ?? '', "booking") ?>>
        <?php $hotel->displayAvailable() ?>
    </section>

    <section id="payment" <?php $webpage->displaySection($_GET["type"] ?? '', "payment") ?>>b</section>

</main>

<?php require_once("../includes/footer.inc.php"); ?>