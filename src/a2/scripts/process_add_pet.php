<?php
// Only run if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json (going up from scripts/ to a2/, then into data/)
$petsFile = __DIR__ . '/../data/pets.json';

// Load existing pets
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Find the next ID — look at the highest existing ID and add 1
$newId = 1;
if (!empty($pets)) {
    $lastPet = end($pets);
    $newId = $lastPet['id'] + 1;
}

// Build the new pet array — matches your existing JSON structure
$newPet = [
    "id" => $newId,
    "name" => htmlspecialchars($_POST['name']),
    "age" => htmlspecialchars($_POST['age']),
    "gender" => htmlspecialchars($_POST['gender']),
    "breed" => htmlspecialchars($_POST['breed']),
    "price" => (float)$_POST['price'],
    "microchip" => htmlspecialchars($_POST['microchip']),
    "tag" => htmlspecialchars($_POST['tag']),
    "sourceNumber" => htmlspecialchars($_POST['sourceNumber']),
    "image" => "placeholder.png",
    "extraImages" => [],
    "additionalInfo" => [
        "paragraphs" => [htmlspecialchars($_POST['description'])],
        "moreInfo" => [
            "Kids" => htmlspecialchars($_POST['kids']),
            "Weight" => htmlspecialchars($_POST['weight']),
            "Status" => "Active"
        ],
        "closing" => "Contact us for more info!"
    ]
];

// Add to the list and save
$pets[] = $newPet;
file_put_contents($petsFile, json_encode($pets, JSON_PRETTY_PRINT));

// Redirect back to admin
header("Location: ../admin.php?success=1");
exit();