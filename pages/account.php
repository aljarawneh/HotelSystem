<?php
// Include class autoloader
require_once("../includes/autoloader.inc.php");

// Webpage object
$webpage = new Webpage("Account - RZA", "account");

// Create Account Object & Fill entry when clicked
$account = new Account($_POST["firstName"] ?? '', $_POST["lastName"] ?? '', $_POST["email"] ?? '', $_POST["password"] ?? '', $_POST["confirmPassword"] ?? '', $_GET["type"] ?? '', $_COOKIE["customerID"] ?? '');

// Account Type Handler
if (isset($_POST["btnSubmit"])) {
    switch ($account->getType()) {
        case 'login': // confirm login
            $result = $account->confirmLogin();
            if ($result) {
                $account->createCookies();
                header("Location:../index.php");
                exit();
                break;
            }
            break;
        case 'register': // confirm register
            $result = $account->confirmRegister();
            if ($result) {
                $account->createCookies();
                header("Location:../index.php");
                exit();
                break;
            }
    }
}

// Redirect if logged in
if (isset($_COOKIE["customerID"])) {
    header("Location:../index.php");
    exit();
} else if (!isset($_COOKIE["customerID"]) && !isset($_GET["type"])) {
    header("Location:account.php?type=register");
    exit();
}


require_once("../includes/header.inc.php"); ?>

<!-- Register -->
<main>
    <!-- Login -->
    <section class="container" <?php $account->displaySection("login") ?>>
        <h1 class="text-white fw-bold text-center">Login</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Login Form -->
        <form method="POST" class="row g-3 needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="email" value="<?php $account->getValue("email"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("email"); ?>" placeholder="example@beanandbrew.com" name="email" required>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="password" class="form-label">Password</label>
                <input value="<?php $account->getValue("password"); ?>" type="password" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Invalid login credentials
                </div>
            </div>
            <a href="#">Forgot Password?</a>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="btnSubmit">Login</button>
            </div>
        </form>
        <!-- Other form of login -->
        <div class="container d-flex col justify-content-center">
            <hr class="w-25">
            <div class="text-center mx-4">Or</div>
            <hr class="w-25">
        </div>

        <div class="container d-flex justify-content-center col-12 text-center mt-3 mb-3">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button class="btn btn-outline-success mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-1" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg>
                    Continue with Google
                </button>
                <button class="btn btn-outline-primary mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook me-1" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg>
                    Continue with Facebook
                </button>
                <button class="btn btn-outline-light mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x me-1" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg>
                    Continue with X
                </button>
            </div>
        </div>

        <div class="text-center mb-5">Don't have an account? <a href="account.php?type=register">Create Account.</a></div>

    </section>

    <!-- Register -->
    <section class="container" <?php $account->displaySection("register") ?>>
        <h1 class="text-white fw-bold text-center">Register</h1>
        <hr class="border border-light border-2 opacity-50 rounded">

        <!-- Registry Form -->
        <form method="POST" class="row g-3 needs-validation gap-1 d-flex justify-content-center" novalidate>
            <!-- First Name -->
            <div class="has-validation">
                <label for="firstName">First name</label>
                <input type="text" value="<?php $account->getValue("firstName"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("firstName"); ?>" placeholder="John" name="firstName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters.
                </div>
            </div>
            <!-- Last Name -->
            <div class="has-validation">
                <label for="lastName">Last name</label>
                <input type="text" value="<?php $account->getValue("lastName"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("lastName"); ?>" placeholder="Doe" name="lastName" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Last name must be above 3 letters and under 20 letters.
                </div>
            </div>
            <!-- Email -->
            <div class="has-validation">
                <label for="email">Email</label>
                <input type="email" value="<?php $account->getValue("email"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("email"); ?>" placeholder="example@beanandbrew.com" name="email" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Email is invalid or taken, please try again.
                </div>
            </div>
            <!-- Password -->
            <div class="has-validation">
                <label for="password">Password</label>
                <input type="password" value="<?php $account->getValue("password"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("password"); ?>" placeholder="Password" name="password" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password must be atleast 5 characters.
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="has-validation">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" value="<?php $account->getValue("confirmPassword"); ?>" class="form-control <?php if (isset($_POST["btnSubmit"])) $account->getValid("confirmPassword"); ?>" placeholder="Confirm Password" name="confirmPassword" required>
                <div class="invalid-feedback">
                    <!-- Invalid input-->
                    Password does not match
                </div>
            </div>
            <!-- Submit -->
            <div class="d-flex justify-content-between col-12">
                <p class="flex-grow-1">By signing up, you agree to our <a href="../index.php?type=tcs">Terms of Use</a>, which include an arbitration clause, and acknowledge our <a href="../index.php?type=privacy">Privacy Policy.</a></p>
                <div>
                    <button class="btn btn-outline-light" type="submit" name="btnSubmit">Register</button>
                </div>
            </div>

        </form>
        <!-- Other form of login -->
        <div class="container d-flex col justify-content-center">
            <hr class="w-25">
            <div class="text-center mx-4">Or</div>
            <hr class="w-25">
        </div>

        <div class="container d-flex justify-content-center col-12 text-center mt-3 mb-3">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button class="btn btn-outline-success mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-1" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg>
                    Continue with Google
                </button>
                <button class="btn btn-outline-primary mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook me-1" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg>
                    Continue with Facebook
                </button>
                <button class="btn btn-outline-light mx-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x me-1" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg>
                    Continue with X
                </button>
            </div>
        </div>

        <div class="text-center mb-5">Already have an account? <a href="account.php?type=login">Login.</a></div>

    </section>
</main>



<?php require_once("../includes/footer.inc.php"); ?>