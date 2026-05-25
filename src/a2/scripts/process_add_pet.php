<?php
session_start();
if (!isset($_SESSION['logged_in'])) { header("Location: ../admin.php"); exit(); }
/* Block access unless admin is logged in */
/* Also ensure this script only runs from a form submission (POST request) */

// Only run if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json (going up from scripts/ to a2/, then into data/)
$petsFile = __DIR__ . '/../data/pets.json';

// Define upload directory and helper function for images
$uploadDir = __DIR__ . '/../images/'; 

// Handles image upload and returns a generated filename if successful
// Returns null if no file was uploaded or upload failed
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

// Load existing pets from JSON file (or start with empty array if file is missing/corrupt)
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Generate next pet ID by taking the last existing ID and adding 1
// (simple approach assuming pets are always appended in order)
$newId = 1;
if (!empty($pets)) {
    $lastPet = end($pets);
    $newId = $lastPet['id'] + 1;
}

// Process uploaded images before saving the new pet
// Main image is required (uses placeholder if missing)
// Extra images are optional as well. They should be able to be left blank
$mainImage = handleUpload('main_image', $uploadDir, $newId, 'main') ?? "placeholder.png";
$extra1    = handleUpload('extra_image_1', $uploadDir, $newId, 'extra1');
$extra2    = handleUpload('extra_image_2', $uploadDir, $newId, 'extra2');

// Filter out empty uploads so we only save valid filenames to the JSON
$extraImagesArray = array_values(array_filter([$extra1, $extra2]));

// Create new pet entry matching the JSON structure used across the site
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
    
    // Update these two lines to use the variables just created
    "image" => $mainImage,
    "extraImages" => $extraImagesArray,
    
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

// Save updated pet list and redirect back to admin with success message
header("Location: ../admin.php?status=added&name=" . urlencode($newPet['name']));
exit();