<?php
session_start();
if (!isset($_SESSION['logged_in'])) { header("Location: ../admin.php"); exit(); }

// Only run if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json (going up from scripts/ to a2/, then into data/)
$petsFile = __DIR__ . '/../data/pets.json';

// --- NEW: Define upload directory and helper function for images ---
$uploadDir = __DIR__ . '/../images/'; 

function handleUpload($fileKey, $uploadDir, $petId, $suffix = 'extra') {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
        $newFileName = "pet_" . $petId . "_" . time() . "_" . $suffix . "." . $extension;
        $targetPath = $uploadDir . $newFileName;
        
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetPath)) {
            return $newFileName;
        }
    }
    return null;
}

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

// --- NEW: Process the 3 image uploads before building the array ---
// If no main image is uploaded, it defaults to "placeholder.png"
$mainImage = handleUpload('main_image', $uploadDir, $newId, 'main') ?? "placeholder.png";
$extra1    = handleUpload('extra_image_1', $uploadDir, $newId, 'extra1');
$extra2    = handleUpload('extra_image_2', $uploadDir, $newId, 'extra2');

// Filter out empty uploads so we only save valid filenames to the JSON
$extraImagesArray = array_values(array_filter([$extra1, $extra2]));
// ------------------------------------------------------------------

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
    
    // --- NEW: Update these two lines to use the variables we just created ---
    "image" => $mainImage,
    "extraImages" => $extraImagesArray,
    // ------------------------------------------------------------------------
    
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
header("Location: ../admin.php?status=added&name=" . urlencode($newPet['name']));
exit();