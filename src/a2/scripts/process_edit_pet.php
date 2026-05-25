<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: ../admin.php");
    exit();
}
// Ensure user is logged in and request is a valid POST submission

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../admin.php");
    exit();
}

// Path to pets.json
$petsFile = __DIR__ . '/../data/pets.json';

$uploadDir = __DIR__ . '/../images/';

// Handles image upload and returns a generated filename if successful
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

// Load existing pets from JSON file (or use empty array if file is missing/corrupt)
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Get ID of pet being edited
$idToEdit = (int)$_POST['id'];

// Find and update the matching pet
$updatedName = '';
// Find the pet being edited and update its details
foreach ($pets as &$pet) {
    if ($pet['id'] === $idToEdit) {
        // Update images only if new files were uploaded
        // Try uploading new files
        $newMain   = handleUpload('main_image', $uploadDir, $idToEdit, 'main');
        $newExtra1 = handleUpload('extra_image_1', $uploadDir, $idToEdit, 'extra1');
        $newExtra2 = handleUpload('extra_image_2', $uploadDir, $idToEdit, 'extra2');

        // Only update 'image' if a new one was actually uploaded
        if ($newMain) {
            $pet['image'] = $newMain;
        }

        // Update extra images while keeping existing ones if no new uploads are provided
        $updatedExtras = $pet['extraImages'] ?? [];
        if ($newExtra1) $updatedExtras[0] = $newExtra1;
        if ($newExtra2) $updatedExtras[1] = $newExtra2;
        $pet['extraImages'] = array_values(array_filter($updatedExtras));

        // Update basic pet information from form input
        $pet['name']         = htmlspecialchars($_POST['name']);
        $pet['age']          = htmlspecialchars($_POST['age']);
        $pet['gender']       = htmlspecialchars($_POST['gender']);
        $pet['breed']        = htmlspecialchars($_POST['breed']);
        $pet['price']        = (float)$_POST['price'];
        $pet['microchip']    = htmlspecialchars($_POST['microchip']);
        $pet['tag']          = htmlspecialchars($_POST['tag']);
        $pet['sourceNumber'] = htmlspecialchars($_POST['sourceNumber']);

        // Update additional pet details (description, kids, weight, status)
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
unset($pet); // Break reference from foreach loop

// Save the updated list back to the file
file_put_contents($petsFile, json_encode($pets, JSON_PRETTY_PRINT));

// Redirect back to admin with confirmation
header("Location: ../admin.php?status=edited&name=" . urlencode($updatedName));
exit();
