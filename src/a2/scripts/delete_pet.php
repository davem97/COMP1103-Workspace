<?php
$petsFile = __DIR__ . '/../data/pets.json';
$idToDelete = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$deletedName = '';

if ($idToDelete > 0 && file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);

    // Find the pet being deleted so we can use its name in the banner
    foreach ($pets as $pet) {
        if ($pet['id'] === $idToDelete) {
            $deletedName = $pet['name'];
            break;
        }
    }

    // Filter out the pet to delete
    $updatedPets = array_filter($pets, function($pet) use ($idToDelete) {
        return $pet['id'] !== $idToDelete;
    });

    $updatedPets = array_values($updatedPets);
    file_put_contents($petsFile, json_encode($updatedPets, JSON_PRETTY_PRINT));
}

// Redirect with status and pet name
header("Location: ../admin.php?status=deleted&name=" . urlencode($deletedName));
exit;