<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage object
$webpage = new Webpage("Hotel ", "hotel");

// Hotel Object
$hotel = new Hotel($_POST["startDate"] ?? '', $_POST["endDate"] ?? '');

require_once("../includes/header.inc.php"); ?>


<main class="container text-white my-2">
    <h1 class="text-white fw-bold text-center">Hotel</h1>
    <hr class="border border-light border-2 opacity-50 rounded">

    <section id="main" <?php $webpage->displaySection($_GET["type"] ?? '', "main") ?>>
        <!-- Filtering date -->
        <form method="post" class="col-md-6 mx-auto">
            <h3 class="text-center"></h3><br>
            <!-- Date-->
            <label for="dateRange1" class="fs-5 pb-2 user-select-none">Select Booking Range </label>
            <div class="input-group mb-3 has-validation">
                <label class="input-group-text">Date</label>
                <input type="text" class="form-control" id="dateRange1" name="startDate" placeholder="Start Date" readonly="readonly" min="today" max="today-30 days + 10 days" />
                <input type="text" class="form-control" id="dateRange2" name="endDate" placeholder="End Date" readonly="readonly" min="today" max="today + 10 days" />
                <button type="button" class="btn btn-light input-group-end" id="dateClear">Clear</button>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Date is empty, please try again.
                </div>
            </div>
            <!-- Room type -->
            <label for="ticketSelect" class="fs-5 pb-2 user-select-none">Room Type: </label>
            <div class="input-group mb-3 has-validation">
                <label class="input-group-text" for="ticketSelect">Type</label>
                <select class="form-select " id="ticketSelect" name="ticketSelect" required>
                    <option selected disabled>Select..</option>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="deluxe">Deluxe Room</option>
                    <option value="family">Family Room</option>
                </select>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Select a room type, please try again.
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="dateSubmit">Submit</button>
        </form>
    </section>

    <section id="booking" <?php $webpage->displaySection($_GET["type"] ?? '', "booking") ?>></section>

    <section id="payment" <?php $webpage->displaySection($_GET["type"] ?? '', "payment") ?>></section>

    <!-- Form -->
    <form method=" post" hidden>
        <hr>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>

<?php require_once("../includes/footer.inc.php"); ?>