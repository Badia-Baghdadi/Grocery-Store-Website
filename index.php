<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Car Rental</title>
  <link rel="stylesheet" href="css/car_grid.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/popup.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <style>
    .header {
      margin-left: 30px;
    }
  </style>
</head>

<body>

  <?php include 'includes/header.php'; ?>
  <div>
    <h1 class="header">All Cars for the Best Experience!!</h1>
  </div>
  <div id="carGridContainer">
    <?php include 'cars_grid.php'; ?>
  </div>

  <script src="js/popup.js"></script>
  <script src="js/calculate_total.js"></script>
  <script src="js/live_feedback.js"></script>
  <script src="js/save_inputs.js"></script>
  <script src="js/filter_selections.js"></script>

  <?php include 'includes/footer.php' ?>