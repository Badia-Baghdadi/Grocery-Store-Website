<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f4f4;
        top: 50%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 300px;
        box-sizing: border-box;
    }

    .confirmation-container {
        background-color: #fff;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        text-align: center;
        margin-top: 50px;
    }

    .confirmation-container h2 {
        color: #28a745;
        font-size: 45px;
        margin-bottom: 15px;
    }

    .confirmation-container h3 {
        color: #555;
        font-size: 30px;
        margin-top: 20px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .confirmation-container p {
        font-size: 25px;
        margin-bottom: 15px;
    }

    .back-to-home {
        margin-top: 30px;
        text-decoration: none;
    }
</style>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = 'json/reservations_log.json';
    $newData = [
        'vin' => $_POST['reserve_vin'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'license' => $_POST['license'],
        'mobile' => $_POST['mobile'],
        'startDate' => $_POST['startDate'],
        'endDate' => $_POST['endDate'],
    ];

    $existingData = [];
    if (file_exists($file)) {
        $jsonFromFile = file_get_contents($file);
        $existingData = json_decode($jsonFromFile, true);
        if (!is_array($existingData)) {
            $existingData = [];
        }
    }

    $existingData[] = $newData;

    $json = json_encode($existingData, JSON_PRETTY_PRINT);
    file_put_contents($file, $json);
    echo "<div class= 'confirmation-container' >";
    echo "<h2>Reservation confirmed. Thank you, {$newData['name']}!</h2>";
    echo "<h3>Reservation details:</h3>";
    echo "<p>Car reseved from {$newData['startDate']} until {$newData['endDate']}</p>";
    echo "<a href='index.php' class='back-to-home'>&larr; Back to Car Listings</a>";
    echo "</div>";
} else {
    echo "<p>Invalid request.</p>";
    echo "<a href='index.php' class='back-to-home'>&larr; Back to Car Listings</a>";
}
?>