<?php
// Checks if the URL contains "classes/" or "includes/"
if (strpos($_SERVER['PHP_SELF'], 'classes/') !== false || strpos($_SERVER['PHP_SELF'], 'includes/') !== false) {
    header('Location: ../index.php');
    exit();
}

// Include
include_once("dbh.class.php");

class Ticket extends Dbh {
    // Properties
    private $type;
    public $date;
    private $select;
    private $quantity;
    private $id;
    private $errors = array();

    // Construct Method to assign properties
    public function __construct($type, $date, $select, $quantity) {
        // Assign Properties
        $this->type = $type;
        $this->date = $this->validateDate($date);
        $this->select = $this->validateSelect($select);
        $this->quantity =  $this->validateQnty($quantity);

        // redirect if no errors
        if (count($this->errors) == 0) {
            $this->setID($this->select);
            $this->storeData();
        }
    }

    // Method to return certain range of ticket types
    private function getResult() {
        // Number mapping
        $ticketTypeMapping = [
            "adult" => 1,
            "children" => 2,
            "family" => 3,
            "educational" => 4
        ];

        $ticketType = $ticketTypeMapping[$this->type]; //assign the number

        $start = ($ticketType - 1) * 4 + 1; //get start range
        $end = $start + 3; // get end range

        $stmt = $this->connect()->prepare("SELECT * FROM `type` WHERE ticketType BETWEEN ? AND ?");
        $stmt->execute([$start, $end]);

        // Return the fetched rows
        return $stmt->fetchAll();
    }

    // Method to return all type data
    private function getAll() {
        $stmt = $this->connect()->prepare("SELECT * FROM `type`");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Method to return certain ticket
    private function getTicket($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM `type` WHERE ticketType = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Method to extract highest and lowest prices for each category
    public function getPriceRange() {
        $result = $this->getAll();
        $prices = [];

        for ($i = 0, $count = count($result); $i < $count; $i += 4) {
            $slice = array_slice($result, $i, 4, true);
            $values = array_column($slice, 'price');
            $prices[] = ['low' => min($values), 'high' => max($values)]; //assign low and high for each price cateogry
        }
        return $prices;
    }

    // Method to put each piece as a description
    public function formatDescription($description) {
        $parts = explode('. ', $description);
        $output = '<ul>';
        foreach ($parts as $part) {
            $output .= '<li>' . trim($part) . "." . '</li>';
        }
        $output .= '</ul>';
        return $output;
    }

    // Method to validate date
    public function validateDate($date) {
        if (strlen($date) == 0) {
            array_push($this->errors, "date");
            return "";
        } else {
            return $date;
        }
    }

    // Method to validate quantity
    public function validateQnty($qnty) {
        if (strlen($qnty) == 0 || $qnty <= 0) {
            array_push($this->errors, "quantity");
            return "";
        } else {
            return $qnty;
        }
    }

    // Method to validate select
    public function validateSelect($select) {
        if (strlen($select) == 0) {
            array_push($this->errors, "date");
            return "";
        } else {
            return $select;
        }
    }

    // Method to check for certain error
    public function errorCheck($error) {
        echo in_array($error, $this->errors) ? "is-invalid" : "is-valid";
    }

    // Method to store post data in session
    public function storeData() {
        // Start the session
        session_start();

        // Store the POST data in session variables
        $_SESSION['post_data'] = [
            'type' => $this->type,
            'date' => $this->date,
            'select' => $this->select,
            'quantity' => $this->quantity,
            'id' => $this->id
        ];

        // Redirect
        header("Location:ticket.php?type=payment");
        exit();
    }

    // Method to assign ID of the ticket picked
    private function setID($select) {
        $result = $this->getResult();
        $indexMap = ['day' => 0, 'week' => 1, 'month' => 2, 'year' => 3];
        $this->id = $result[$indexMap[$select]]["ticketType"];
        echo $this->id;
    }

    // Method to return inserted value
    public function returnInput($type) {
        if ($type == "date") {
            echo $this->date;
        } elseif ($type == $this->select) {
            return "selected";
        } elseif ($type == "quantity") {
            echo $this->quantity;
        }
    }

    // Method to calculate and return the end date
    public function calculateEnd($date, $select) {
        // Convert date
        $startDate = DateTime::createFromFormat('D j F', $date);

        return $startDate->modify("+1 $select")->format('l jS F Y');
    }

    // Method to display ticket summary
    public function displayInformation() {
        $result = $this->getTicket($_SESSION["post_data"]["id"]);
        echo
        '<div class="row">
            <div class="col-lg-6">
                <h3 class="h5 text-decoration-underline">Ticket Information</h3>
                <p>' . "<strong>Ticket Name</strong><br>" . ucfirst($_SESSION["post_data"]["select"]) . " Ticket (" . ucfirst($_SESSION["post_data"]["type"]) . ")" . '<br>
                    ' . "<strong>Ticket Validity Period</strong><br>" . DateTime::createFromFormat('D j F', $_SESSION["post_data"]["date"])->format('l jS F Y') . ' - ' . $this->calculateEnd($_SESSION["post_data"]["date"], $_SESSION["post_data"]["select"]) . ' <br>
                    ' . "<strong>Purchase Time</strong><br>" . (new DateTime())->format('l jS F Y, h:i A') . '</p>
            </div>
            <div class="col-lg-6">
                <h3 class="h5 text-decoration-underline">Ticket Cost</h3>
                <p>
                <strong>Quantity:</strong> ' . $_SESSION["post_data"]["quantity"] . '<br>
                <strong>Price:</strong> £' . number_format($_SESSION["post_data"]["quantity"] * $result["price"], 2) . '(VAT included)
                </p>
            </div>
        </div>';
    }

    // Method to display ticket summary
    public function displaySummary() {
        $result = $this->getTicket($_SESSION["post_data"]["id"]);
        echo
        '<form method="post" class="p-3 bg-light bg-opacity-10 m-0">
            <h6 class="card-title mb-3">Order Summary</h6>
            <div class="d-flex justify-content-between mb-1 small">
                <span>Subtotal</span> <span>£' . number_format($_SESSION["post_data"]["quantity"] * $result["price"], 2) . '</span>
            </div>
            <div class="d-flex justify-content-between mb-1 small">
                <span>Discount</span> <span class="text-danger">-£0.00</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4 small">
                <span>Total</span> <strong>£' . number_format($_SESSION["post_data"]["quantity"] * $result["price"], 2) . '</strong>
            </div>
            <div class="form-check mb-1 small">
                <input class="form-check-input" type="checkbox" value="" id="tnc" required>
                <label class="form-check-label" for="tnc">
                    I agree to the <a href="../index.php?type=tcs" target="_blank">terms and conditions</a>
                </label>
            </div>
            <button class="btn btn-primary w-100 mt-2" name="submitBtn" >Place order</button>
        </form>';
    }


    // Method to display all ticket category
    public function displayCards() {
        $result = $this->getAll(); // get value
        $prices = $this->getPriceRange();

        // Get 1 example of each cateogry
        $category = array_filter($result, function ($key) {
            return ($key + 1) % 4 == 0;
        }, ARRAY_FILTER_USE_KEY);

        // Counter
        $counter = 1;
        // Display all payment types
        for ($i = 3; $i < count($result); $i += 4) {
?>
            <!-- <?php echo trim(explode("-", $category[$i]["ticketName"])[0]) ?> -->
            <div class="col-md-3 col-lg-3 mb-4">
                <div class="card h-100 text-bg-white" style="width: 300px !important;">
                    <img src="../images/logo-dark.png" class="card-img-top" alt="animals photo" width="260px" height="300px">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center"><?php echo trim(explode("-", $category[$i]["ticketName"])[0]) ?> Tickets</h5>
                        <p class="card-text text-start">
                            <?php echo $this->formatDescription($category[$i]["ticketDescription"]); ?>
                        </p>
                        <div class="mt-auto d-flex justify-content-between border-top pt-2">
                            <span class="fs-5"><?php echo "£" . $prices[$counter - 1]["low"] . " - " . $prices[$counter - 1]["high"] ?></span>
                            <a href="ticket.php?type=<?php echo lcfirst(trim(explode("-", $category[$i]["ticketName"])[0])) ?>" class="btn btn-outline-light">Check Ticket</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php
            $counter++;
        }
    }


    // Method to display all ticket options of a type in payment
    public function displayOptions() {
        $result = $this->getResult();
        for ($i = 0; $i < 4; $i++) {
        ?>
            <div class="col-md-3 col-lg-3 mb-4 d-flex justify-content-center">
                <div class="card h-100 text-bg-white" style="width: 300px !important;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="white-space: nowrap;"><?php echo trim(end(explode("-", $result[$i]["ticketName"]))); ?></h5>
                        <span class="fs-5 card-text">£<?php echo number_format($result[$i]["price"], 2) ?></span>
                    </div>
                </div>
            </div>

<?php
        }
    }

    // Method to display all select option
    public function displaySelect() {
        $result = $this->getResult();
        echo '
                <option ' . $this->returnInput("day") . ' value="day">' . $result[0]["ticketName"] . '</option>
                <option ' . $this->returnInput("week") . ' value="week">' . $result[1]["ticketName"] . '</option>
                <option ' . $this->returnInput("month") . ' value="month">' . $result[2]["ticketName"] . '</option>
                <option ' . $this->returnInput("year") . ' value="year">' . $result[3]["ticketName"] . '</option>';
    }
}
