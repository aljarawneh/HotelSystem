<!doctype html>
<html lang="en">

<head>
    <title>View Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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
                        <a class="nav-link" aria-current="page" href="index.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-bg-light" href="booking.php">View Bookings</a>
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

    <main>



    </main>

    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>