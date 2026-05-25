<?php
session_start();
if (!isset($_SESSION['logged_in'])) { header("Location: ../admin.php"); exit(); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json
$petsFile = __DIR__ . '/../data/pets.json';

// Load existing pets
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Get the ID of the pet to update
$idToEdit = (int)$_POST['id'];

// Find and update the matching pet
$updatedName = '';
foreach ($pets as &$pet) {  // Note the & - this is "pass by reference" so changes apply to the array
    if ($pet['id'] === $idToEdit) {
        $pet['name']         = htmlspecialchars($_POST['name']);
        $pet['age']          = htmlspecialchars($_POST['age']);
        $pet['gender']       = htmlspecialchars($_POST['gender']);
        $pet['breed']        = htmlspecialchars($_POST['breed']);
        $pet['price']        = (float)$_POST['price'];
        $pet['microchip']    = htmlspecialchars($_POST['microchip']);
        $pet['tag']          = htmlspecialchars($_POST['tag']);
        $pet['sourceNumber'] = htmlspecialchars($_POST['sourceNumber']);
        $updatedName = $pet['name'];
        break;
    }
}
unset($pet); // Break the reference (PHP best practice after foreach with &)

// Save the updated list back to the file
file_put_contents($petsFile, json_encode($pets, JSON_PRETTY_PRINT));

// Redirect back to admin with confirmation
header("Location: ../admin.php?status=edited&name=" . urlencode($updatedName));
exit();