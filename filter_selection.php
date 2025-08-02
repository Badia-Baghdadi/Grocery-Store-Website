<?php
$filtered_cars = json_decode(file_get_contents('json/cars.json'), true);

$filter_type = $_POST['type'] ?? '';
$filter_brand = $_POST['brand'] ?? '';
$filter_model = $_POST['model'] ?? '';

if (!empty($filter_type) && $filter_type !== 'All') {
    $filtered_cars = array_filter($filtered_cars, function ($car) use ($filter_type) {
        return $car['type'] === $filter_type;
    });
}

if (!empty($filter_brand) && $filter_brand !== 'All') {
    $filtered_cars = array_filter($filtered_cars, function ($car) use ($filter_brand) {
        return $car['brand'] === $filter_brand;
    });
}

if (!empty($filter_model) && $filter_model !== 'All') {
    $filtered_cars = array_filter($filtered_cars, function ($car) use ($filter_model) {
        return $car['model'] === $filter_model;
    });
}

if (empty($filtered_cars)): ?>
    <p class="no-cars-found">No cars found matching your criteria.</p>
<?php else:
    foreach ($filtered_cars as $car): ?>
        <div class="grid">
            <div class='car-card'>
                <img src="<?= htmlspecialchars($car['image']) ?>"
                    alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>">
                <p><?= htmlspecialchars($car['description']) ?></p>
                <p><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></p>
                <p><strong>Type:</strong> <?= htmlspecialchars($car['type']) ?></p>
                <p><strong>Year:</strong> <?= htmlspecialchars($car['year']) ?></p>
                <p data-price="<?= htmlspecialchars($car['rentalPricePerDay']) ?>">
                    <strong>Price/Day:</strong> $<?= htmlspecialchars(number_format($car['rentalPricePerDay'], 2)) ?>
                </p>
                <p><strong>Seats:</strong> <?= htmlspecialchars($car['numberOfSeats']) ?></p>
                <p><strong>Available:</strong><?= htmlspecialchars($car['availability'] ? 'Yes' : 'No') ?></p>

                <button type="button" class="reserve-btn <?= $car['availability'] ? 'availability-btn' : 'unavailable-btn' ?>"
                    <?= $car['availability'] ? '' : 'disabled' ?> data-vin="<?= htmlspecialchars($car['vin']) ?>">
                    <?= $car['availability'] ? 'Reserve' : 'Unavailable' ?>
                </button>
            </div>
            <div id="reservationPopup" class="popup hidden">
                <div class="popup-content">
                    <div id="popupDynamicContent">
                        Loading reservation details...
                    </div>
                </div>
            </div>
        </div>
        <script src="js/popup.js"></script>
        <script src="js/calculate_total.js"></script>
        <script src="js/live_feedback.js"></script>
        <script src="js/save_inputs.js"></script>
        <script src="js/filter_selections.js"></script>
    <?php endforeach;
endif;
?>