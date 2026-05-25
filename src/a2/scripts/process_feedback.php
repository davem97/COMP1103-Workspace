<?php
/**
 * process_feedback.php
 * Handles the submission of the feedback form, sanitizes input, 
 * and persists data to a JSON file.
 */

// 1. Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. SANITIZATION (Security Consideration)
    // strip_tags and htmlspecialchars prevent Cross-Site Scripting (XSS)
    $fullname = htmlspecialchars(strip_tags($_POST['fullname']));
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message  = htmlspecialchars(strip_tags($_POST['message']));

    // 3. Create the data object
    $newEntry = [
        "id"        => uniqid(), // Gives every feedback a unique ID (useful for Admin Portal later)
        "fullname"  => $fullname,
        "email"     => $email,
        "message"   => $message,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    // 4. PERSISTENCE (JSON Implementation)
    // Use __DIR__ to find the file relative to this script
    $filePath = __DIR__ . '/feedback.json';

    // Get current contents or start with an empty array if file is missing/empty
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $dataList = json_decode($jsonData, true);
    } else {
        $dataList = [];
    }

    // Ensure $dataList is an array (in case the file was empty)
    if (!is_array($dataList)) {
        $dataList = [];
    }

    // Add the new entry to the array
    $dataList[] = $newEntry;

    // Convert back to JSON and save
    // JSON_PRETTY_PRINT makes it easy for your teacher to read the file manually
    file_put_contents($filePath, json_encode($dataList, JSON_PRETTY_PRINT));

    // 5. REDIRECT
    // Move up one directory back to the main feedback page
    header("Location: ../feedback.php?status=success");
    exit();
} else {
    // If someone tries to access this file directly without posting, send them home
    header("Location: ../index.html");
    exit();
}