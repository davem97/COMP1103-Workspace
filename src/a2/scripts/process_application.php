<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../application.php");
    exit();
}
/* Only allow this script to run from a form submission (POST request) */

// Get form inputs and clean them to prevent unsafe HTML/script injection
$firstname     = htmlspecialchars($_POST['firstname']);
$surname       = htmlspecialchars($_POST['surname']);
$email         = htmlspecialchars($_POST['email']);
$phone         = htmlspecialchars($_POST['phone']);
$housing       = htmlspecialchars($_POST['housing']);
$yardType      = htmlspecialchars($_POST['yardType'] ?? '');
$petExperience = htmlspecialchars($_POST['petExperience'] ?? '');
$petName       = htmlspecialchars($_POST['petName'] ?? '');
$petId         = htmlspecialchars($_POST['petId'] ?? '');

// Build a single application record to store in JSON
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

// Path to applications storage file
$file = __DIR__ . '/../data/applications.json';

// Load existing applications (or start with empty list if file doesn't exist or is invalid)
$applications = [];
if (file_exists($file)) {
    $applications = json_decode(file_get_contents($file), true);
    if (!is_array($applications)) {
        $applications = [];
    }
}

$applications[] = $newApplication;
file_put_contents($file, json_encode($applications, JSON_PRETTY_PRINT));

// Add new application, save to file, then redirect with success message
header("Location: ../application.php?status=success");
exit();
