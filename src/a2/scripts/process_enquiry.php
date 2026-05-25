<?php
// Handles volunteer enquiry form submission and saves it to enquiries.json

// Only allow form submissions via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../volunteer.php");
    exit();
}

// Clean user input and set default values where needed
$fullName = htmlspecialchars(trim($_POST['fullName'] ?? ''));
$email    = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone    = htmlspecialchars(trim($_POST['phone'] ?? ''));
$role     = htmlspecialchars(trim($_POST['role'] ?? 'General'));
$message  = htmlspecialchars(trim($_POST['message'] ?? ''));

// Build a single enquiry record
$newEnquiry = [
    "id"       => uniqid(),
    "fullName" => $fullName,
    "email"    => $email,
    "phone"    => $phone,
    "role"     => $role,
    "message"  => $message,
    "date"     => date("Y-m-d H:i:s")
];

// Load existing enquiries (or start with empty array if file is missing/corrupt)
$enquiriesFile = __DIR__ . '/../data/enquiries.json';
$enquiries = [];
if (file_exists($enquiriesFile)) {
    $enquiries = json_decode(file_get_contents($enquiriesFile), true);
    if (!is_array($enquiries)) {
        $enquiries = [];
    }
}

// Add new enquiry and save updated list
$enquiries[] = $newEnquiry;
file_put_contents($enquiriesFile, json_encode($enquiries, JSON_PRETTY_PRINT));

// Redirect back to volunteer page with success message
header("Location: ../volunteer.php?enquiry=success&name=" . urlencode($fullName));
exit();
?>