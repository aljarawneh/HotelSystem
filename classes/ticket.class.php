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
    private $date;
    private $select;
    private $errors = array();

    // Construct Method to assign properties
    public function __construct($type, $date, $select) {
        // Assign Properties
        $this->type = $type;
        $this->date = $this->validateDate($date);
        $this->select = $this->validateSelect($select);

        // redirect if no errors
        if (count($this->errors) == 0) {
            header("Location:ticket.php?type=payment");
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

    // Method to validate select
    public function validateSelect($select) {
        return strlen($select) == 0 ? array_push($this->errors, "select") : $select;
    }

    // Method to check for certain error
    public function errorCheck($error) {
        echo in_array($error, $this->errors) ? "is-invalid" : "is-valid";
    }

    // Method to return inserted value
    public function returnInput($type) {
        if ($type == "date") {
            echo $this->date;
        } elseif ($type == $this->select) {
            return "selected";
        }
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
