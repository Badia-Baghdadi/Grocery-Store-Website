<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/car_grid.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <style>
        .back-link {
            display: block;
            margin-top: 40px;
            text-align: left;
            text-decoration: none;
            color: #007bff;
            margin-left: 10px;
        }

        .header {
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="search-container">
        <h1 class="header">Search Results</h1>
        <?php
        $query = $_GET['query'] ?? '';
        $query = strtolower(trim($query));

        if (empty($query)) {
            echo "<p>Please enter a search query.</p>";
        } else {

            $cars = json_decode(file_get_contents('json/cars.json'), true);

            $matchedCars = [];
            foreach ($cars as $car) {
                if (
                    stripos($car['brand'], $query) !== false ||
                    stripos($car['model'], $query) !== false ||
                    stripos($car['type'], $query) !== false ||
                    stripos((string) $car['year'], $query) !== false
                ) {
                    $matchedCars[] = $car;
                }
            }

            if (count($matchedCars) > 0) {
                echo "<p class='header'>Showing results for: <strong>" . htmlspecialchars($_GET['query']) . "</strong></p>";
                echo "<div class='grid'>";
                foreach ($matchedCars as $car) {
                    echo "<div class='car-card'>"; ?>

                    <img src="<?= htmlspecialchars($car['image']) ?>"
                        alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>">
                    <p><?= htmlspecialchars($car['description']) ?></p>
                    <p><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></p>
                    <p><strong>Type:</strong> <?= htmlspecialchars($car['type']) ?></p>
                    <p><strong>Year:</strong> <?= htmlspecialchars($car['year']) ?></p>
                    <strong>Price/Day:</strong> $<?= htmlspecialchars(number_format($car['rentalPricePerDay'], 2)) ?></p>
                    <p><strong>Seats:</strong> <?= htmlspecialchars($car['numberOfSeats']) ?></p>
                    <p><strong>Available:</strong><?= htmlspecialchars($car['availability'] ? 'Yes' : 'No') ?></p>
                    <input type="hidden" name="car_id" value="<?= htmlspecialchars($car['vin']) ?>">

                    <button type="button" class="reserve-btn <?= $car['availability'] ? 'availability-btn' : 'unavailable-btn' ?>"
                        <?= $car['availability'] ? '' : 'disabled' ?> data-vin="<?= htmlspecialchars($car['vin']) ?>">
                        <?= $car['availability'] ? 'Reserve' : 'Unavailable' ?>
                    </button>
                    <?php
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No cars found matching your search for: <strong>" . htmlspecialchars($_GET['query']) . "</strong></p>";
            }
        }
        ?>
        <div id="reservationPopup" class="popup hidden">
            <div class="popup-content">
                <button id="closePopup" class="close-btn">&times;</button>
                <div id="popupDynamicContent">
                    Loading reservation details...
                </div>
            </div>
        </div>
        <a href="index.php" class="back-link">&larr; Back to Search</a>

    </div>

    <script src="js/popup.js"></script>
    <script src="js/calculate_total.js"></script>
    <script src="js/live_feedback.js"></script>
    <script src="js/save_inputs.js"></script>
    <script src="js/filter_selections.js"></script>

    <?php include 'includes/footer.php' ?>