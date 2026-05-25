<?php

/**
 * process_feedback.php
 * Handles feedback form submission and saves data to a JSON file
 */

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Clean user input to prevent XSS attacks
    $fullname = htmlspecialchars(strip_tags($_POST['fullname']));
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message  = htmlspecialchars(strip_tags($_POST['message']));

    // Create a feedback entry object
    $newEntry = [
        "id"        => uniqid(), // Gives every feedback a unique ID (useful for Admin Portal later)
        "fullname"  => $fullname,
        "email"     => $email,
        "message"   => $message,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    // Path to feedback storage file
    $filePath = __DIR__ . '/feedback.json';

    // Load existing feedback or start with empty array
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $dataList = json_decode($jsonData, true);
    } else {
        $dataList = [];
    }

    // Ensure data is always an array before adding new entry
    if (!is_array($dataList)) {
        $dataList = [];
    }

    // Add new feedback and save back to file
    $dataList[] = $newEntry;

    // Convert back to JSON and save
    file_put_contents($filePath, json_encode($dataList, JSON_PRETTY_PRINT));

     // Redirect back to feedback page with success status
    header("Location: ../feedback.php?status=success");
    exit();
} else {
    // Block direct access to this script
    header("Location: ../index.html");
    exit();
}
