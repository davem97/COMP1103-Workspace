<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: ../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json
$petsFile = __DIR__ . '/../data/pets.json';

$uploadDir = __DIR__ . '/../images/';

function handleUpload($fileKey, $uploadDir, $petId, $suffix = 'extra')
{
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

// Get the ID of the pet to update
$idToEdit = (int)$_POST['id'];

// Find and update the matching pet
$updatedName = '';
foreach ($pets as &$pet) {
    if ($pet['id'] === $idToEdit) {
        // --- 1. HANDLE IMAGES ---
        // Try uploading new files
        $newMain   = handleUpload('main_image', $uploadDir, $idToEdit, 'main');
        $newExtra1 = handleUpload('extra_image_1', $uploadDir, $idToEdit, 'extra1');
        $newExtra2 = handleUpload('extra_image_2', $uploadDir, $idToEdit, 'extra2');

        // Only update 'image' if a new one was actually uploaded
        if ($newMain) {
            $pet['image'] = $newMain;
        }

        // Handle extra images (keep old ones if no new ones are uploaded)
        $updatedExtras = $pet['extraImages'] ?? [];
        if ($newExtra1) $updatedExtras[0] = $newExtra1;
        if ($newExtra2) $updatedExtras[1] = $newExtra2;
        $pet['extraImages'] = array_values(array_filter($updatedExtras));

        // --- 2. HANDLE BASIC FIELDS ---
        $pet['name']         = htmlspecialchars($_POST['name']);
        $pet['age']          = htmlspecialchars($_POST['age']);
        $pet['gender']       = htmlspecialchars($_POST['gender']);
        $pet['breed']        = htmlspecialchars($_POST['breed']);
        $pet['price']        = (float)$_POST['price'];
        $pet['microchip']    = htmlspecialchars($_POST['microchip']);
        $pet['tag']          = htmlspecialchars($_POST['tag']);
        $pet['sourceNumber'] = htmlspecialchars($_POST['sourceNumber']);

        // --- 3. HANDLE ADDITIONAL INFO ---
        // This ensures we save the description and moreInfo fields
        $pet['additionalInfo'] = [
            "paragraphs" => [htmlspecialchars($_POST['description'] ?? '')],
            "moreInfo" => [
                "Kids"   => htmlspecialchars($_POST['kids'] ?? ''),
                "Weight" => htmlspecialchars($_POST['weight'] ?? ''),
                "Status" => $pet['additionalInfo']['moreInfo']['Status'] ?? "Active"
            ],
            "closing" => $pet['additionalInfo']['closing'] ?? "Contact us for more info!"
        ];

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
