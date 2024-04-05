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

    // Construct Method to assign properties
    public function __construct($type) {
        $this->type = $type;
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
                <option value="day">' . $result[0]["ticketName"] . '</option>
                <option value="week">' . $result[1]["ticketName"] . '</option>
                <option value="month">' . $result[2]["ticketName"] . '</option>
                <option value="year">' . $result[3]["ticketName"] . '</option>';
    }
}
