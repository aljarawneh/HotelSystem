<!doctype html>
<html lang="en">
<?php

$profile = new Profile("", "", "", "", "", $_COOKIE["customerID"] ?? '');

?>

<head>
    <title><?php $webpage->getTitle() ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/logo-light.png" type="image/x-icon">
    <!-- Flatpickr CSS-->
    <?php if ($webpage->showFlatpickr()) { ?>
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <?php } ?>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Customer CSS -->
    <link rel="stylesheet" href="../styles/mystyles.css">
</head>

<body class="text-white" data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-pills">
        <div class="container-fluid">
            <!-- Logo -->
            <img src="/images/logo-light.png" class="navbar-brand img-fluid user-select-none" alt="logo" width="50" draggable="false" />

            <!-- Button for smaller view width -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Options -->
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("index") ?>" aria-current="page" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("about") ?>" href="../pages/about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("discover") ?>" href="../pages/discover.php">Discover</a></li>
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("hotel") ?>" href="../pages/hotel.php">Hotel</a></li>
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("ticket") ?>" href="../pages/ticket.php">Ticket</a></li>
                    <li class="nav-item"><a class="nav-link <?php $webpage->getActive("animal") ?>" href="../pages/animal.php">Animal</a></li>
                </ul>
                <!-- Buttons -->
                <div class="d-flex justify-content-center gap-2 text-center">
                    <!-- Bookings Button-->
                    <a class="btn btn-light" href="../pages/booking.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z" />
                        </svg>
                    </a>
                    <!-- Dark/Light Mode Button -->
                    <button class="btn btn-light" type="button" id="themeBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-basket-fill" viewBox="0 0 16 16">
                            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708" />
                        </svg>
                    </button>
                </div>
                <!-- Account dropdown -->
                <div class="navbar-nav m-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-bg-light" id="accountDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end w-100 mw-100 mt-2">
                            <?php if (isset($_COOKIE["customerID"])) { ?>
                                <li><a class="dropdown-item" href="../pages/profile.php"><?php $profile->getName() ?></a></li>
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