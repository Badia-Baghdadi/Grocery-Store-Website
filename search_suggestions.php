<?php
header('Content-Type: application/json');

$query = $_GET['query'] ?? '';
$query = strtolower(trim($query));

if (empty($query)) {
    echo json_encode([]);
    exit;
}

$cars = json_decode(file_get_contents('json/cars.json'), true);
$suggestions = [];
$addedSuggestions = [];

foreach ($cars as $car) {
    if (stripos($car['brand'], $query) !== false) {
        $suggestion = $car['brand'];
        if (!in_array($suggestion, $addedSuggestions)) {
            $suggestions[] = $suggestion;
            $addedSuggestions[] = $suggestion;
        }
    }
    if (stripos($car['model'], $query) !== false) {
        $suggestion = $car['model'];
        if (!in_array($suggestion, $addedSuggestions)) {
            $suggestions[] = $suggestion;
            $addedSuggestions[] = $suggestion;
        }
    }
    if (stripos($car['type'], $query) !== false) {
        $suggestion = $car['type'];
        if (!in_array($suggestion, $addedSuggestions)) {
            $suggestions[] = $suggestion;
            $addedSuggestions[] = $suggestion;
        }
    }
    if (stripos((string) $car['year'], $query) !== false) {
        $suggestion = (string) $car['year'];
        if (!in_array($suggestion, $addedSuggestions)) {
            $suggestions[] = $suggestion;
            $addedSuggestions[] = $suggestion;
        }
    }
}

$suggestions = array_slice($suggestions, 0, 5); // only 5 relevant suggestions to show 

echo json_encode($suggestions);
?>