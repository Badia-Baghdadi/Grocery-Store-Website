<div class="grid">
    <?php
    $cars = json_decode(file_get_contents('json/cars.json'), true);

    foreach ($cars as $car): ?>
        <div class='car-card'>
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
        </div>
    <?php endforeach;
    ?>

    <div id="reservationPopup" class="popup hidden">
        <div class="popup-content">
            <button id="closePopup" class="close-btn">&times;</button>
            <div id="popupDynamicContent">
                Loading reservation details...
            </div>
        </div>
    </div>
</div>