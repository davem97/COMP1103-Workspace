<?php
// 1. Setup paths
$petsFile = __DIR__ . '/../data/pets.json';

// 2. Get the ID from the URL (e.g., delete_pet.php?id=3)
$idToDelete = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idToDelete > 0 && file_exists($petsFile)) {
    // 3. Load the current data
    $pets = json_decode(file_get_contents($petsFile), true);

    // 4. Filter the array: Keep everything EXCEPT the ID we want to delete
    $updatedPets = array_filter($pets, function($pet) use ($idToDelete) {
        return $pet['id'] !== $idToDelete;
    });

    // 5. Re-index the array (prevents JSON from turning into an object)
    $updatedPets = array_values($updatedPets);

    // 6. Save the new list back to the file
    file_put_contents($petsFile, json_encode($updatedPets, JSON_PRETTY_PRINT));
}

// 7. Redirect back to the admin portal
header("Location: ../admin.php?status=deleted");
exit;