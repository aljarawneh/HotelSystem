<?php
if (isset($_POST["idSubmit"])) {
    setcookie("userID", $_POST["id"] > 0 ? $_POST["id"] : 1, time() + (86400 * 30), "/");
}
if (isset($_POST["dateSubmit"])) {
    print_r($_POST);
};
?>

<!doctype html>
<html lang="en">

<head>
    <title>Book</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Flatpickr CSS-->
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-pills" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Logo -->
            <span class="navbar-brand user-select-none">Logo</span>

            <!-- Button for smaller view width -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Options -->
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link active text-bg-light" aria-current="page" href="index.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="booking.php">View Bookings</a>
                    </li>
                </ul>
                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-2 text-center">
                    <!-- Shopping Cart Button-->
                    <a class="btn btn-light" href="booking.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z" />
                        </svg>
                    </a>
                </div>
                <!-- Account dropdown -->
                <div class="navbar-nav m-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end w-100 mw-100 mt-2">
                            <?php if (isset($_COOKIE["customerID"])) { ?>
                                <li><a class="dropdown-item" href="../pages/profile.php">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../pages/profile.php?type=logout">Log out</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="../pages/account.php?type=login">Login</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../pages/account.php?type=register">Register</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        <!-- Account number change -->
        <form method="post">
            <div class="mb-5">
                <label for="id" class="form-label">Customer ID</label>
                <input type="number" class="form-control" name="id" aria-describedby="helpId" placeholder="1" />
                <button type="submit" class="m-1 btn float-end btn-light" name="idSubmit">Submit</button>
            </div>
        </form>

        <!-- Filtering date -->
        <form method="post">
            <hr>
            <h3>Choose a time for your booking:</h3><br>
            <label for="dateRange1">From:</label>
            <input type="text" id="dateRange1" name="startDate" placeholder="Select Date.." readonly="readonly" />
            <!-- To -->
            <label for="dateRange2">To:</label>
            <input type="text" id="dateRange2" name="endDate" placeholder="Select Date.." readonly="readonly" />
            <button type="button" class="btn btn-light" id="dateRangeClear">Clear</button>
            <button type="submit" class="btn btn-success" name="dateSubmit">Submit</button>
        </form>


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

    <footer>
        <!-- place footer here -->
    </footer>
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/scripts/index.js" defer></script>
</body>

</html>