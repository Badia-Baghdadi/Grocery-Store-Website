<style>
  .back-link {
    display: block;
    margin-top: 40px;
    text-align: left;
    text-decoration: none;
    color: #007bff;
  }

  .popup-content {
    max-width: 800px;
    width: 95%;
  }

  .container {
    display: flex;
    gap: 20px;
  }

  .car-grid {
    padding: 15px;
    width: 250px;
    text-align: center;
  }

  .car-grid img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .form-grid {
    flex-grow: 1;
    min-width: 300px;
    padding: 15px;
  }

  #reservationForm {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  #reservationForm label {
    font-weight: bold;
    margin-bottom: 5px;
  }

  #reservationForm input[type="text"],
  #reservationForm input[type="email"] {
    width: calc(100% - 22px);
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    padding: 5px;
  }

  #reservationForm .error {
    color: red;
    font-size: 0.85em;
    margin-top: 5px;
    display: block;
  }

  .form-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
  }

  .form-buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s ease;
  }

  .form-buttons .close-btn {
    background-color: #ddd;
    color: #333;
  }

  .form-buttons .close-btn:hover {
    background-color: #ccc;
  }

  #submitBtn {
    background-color: #4CAF50;
    color: white;
  }

  #submitBtn:hover {
    background-color: #45a049;
  }
</style>

<?php
header('Content-Type: text/html');
$cars = json_decode(file_get_contents('json/cars.json'), true);

$selected_vin = isset($_POST['car_vin']) ? $_POST['car_vin'] : '';

$selected_car = null;

if (!empty($selected_vin)) {
  foreach ($cars as $car) {
    if ($car['vin'] === $selected_vin) {
      $selected_car = $car;
      break;
    }
  }
}

if ($selected_car === null): ?>

  <p class='empty_selection'>No car selected for reservation.</p>
  <a href="#" id="closePopupContent" class="back-link">&larr; Back to Search</a>

<?php else:
  ?>
  <h2>Reserve your Car</h2>
  <div class="container">
    <div class='car-grid'>
      <img src="<?= htmlspecialchars($selected_car['image']) ?>"
        alt="<?= htmlspecialchars($selected_car['brand'] . ' ' . $selected_car['model']) ?>">
      <p><?= htmlspecialchars($selected_car['description']) ?></p>
      <p><?= htmlspecialchars($selected_car['brand'] . ' ' . $selected_car['model']) ?></p>
      <p><strong>Type:</strong> <?= htmlspecialchars($selected_car['type']) ?></p>
      <p><strong>Year:</strong> <?= htmlspecialchars($selected_car['year']) ?></p>
      <p id="rentalPrice" data-price="<?= htmlspecialchars($selected_car['rentalPricePerDay']) ?>">
        <strong>Price/Day:</strong> $<?= htmlspecialchars(number_format($selected_car['rentalPricePerDay'], 2)) ?>
      </p>
      <p><strong>Seats:</strong> <?= htmlspecialchars($selected_car['numberOfSeats']) ?></p>
    </div>
    <div class="form-grid">
      <form id="reservationForm" method="POST" action="confirm_reservation.php">
        <input type="hidden" name="reserve_vin" value="<?= htmlspecialchars($selected_car['vin']) ?>">
        <label>
          Start Date:
          <input type="text" name="startDate" id="startDate" required>
        </label>

        <label>
          End Date:
          <input type="text" name="endDate" id="endDate" required>
        </label>

        <p>Total: <span id="totalPrice">$0.00</span></p>

        <label>
          Name:
          <input type="text" name="name" id="name" required>
          <span class="error" id="nameError"></span>
        </label>

        <label>
          Email:
          <input type="email" name="email" id="email" required>
          <span class="error" id="emailError"></span>
        </label>

        <label>
          Driver License Number:
          <input type="text" name="license" id="licenseNumber" required>
          <span class="error" id="licenseError"></span>
        </label>

        <label>
          Mobile Number:
          <input type="text" name="mobile" id="mobileNumber" required>
          <span class="error" id="mobileError"></span>
        </label>

        <div class="form-buttons">
          <button class="close-btn" type="button"> Cancel </button>
          <button type="submit" id="submitBtn">Confirm</button>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>