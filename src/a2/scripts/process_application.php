<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../application.php");
    exit();
}

// Sanitize all inputs
$firstname     = htmlspecialchars($_POST['firstname']);
$surname       = htmlspecialchars($_POST['surname']);
$email         = htmlspecialchars($_POST['email']);
$phone         = htmlspecialchars($_POST['phone']);
$housing       = htmlspecialchars($_POST['housing']);
$yardType      = htmlspecialchars($_POST['yardType'] ?? '');
$petExperience = htmlspecialchars($_POST['petExperience'] ?? '');
$petName       = htmlspecialchars($_POST['petName'] ?? '');
$petId         = htmlspecialchars($_POST['petId'] ?? '');

// Build the new application
$newApplication = [
    "firstname"     => $firstname,
    "surname"       => $surname,
    "email"         => $email,
    "phone"         => $phone,
    "housing"       => $housing,
    "yardType"      => $yardType,
    "petExperience" => $petExperience,
    "petName"       => $petName,
    "petId"         => $petId,
    "date"          => date("Y-m-d H:i:s")
];

// Save to applications.json
$file = __DIR__ . '/../data/applications.json';

// Load existing applications
$applications = [];
if (file_exists($file)) {
    $applications = json_decode(file_get_contents($file), true);
    if (!is_array($applications)) {
        $applications = [];
    }
}

$applications[] = $newApplication;
file_put_contents($file, json_encode($applications, JSON_PRETTY_PRINT));

// Redirect back with success
header("Location: ../application.php?status=success");
exit();