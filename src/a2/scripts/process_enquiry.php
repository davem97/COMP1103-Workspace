<?php
// Process volunteer enquiry submissions and save them to enquiries.json

// Only handle POST submissions; everything else gets redirected away
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../volunteer.php");
    exit();
}

// Sanitise all user input to prevent XSS
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

// Load existing enquiries from JSON file
$enquiriesFile = __DIR__ . '/../data/enquiries.json';
$enquiries = [];
if (file_exists($enquiriesFile)) {
    $enquiries = json_decode(file_get_contents($enquiriesFile), true);
    if (!is_array($enquiries)) {
        $enquiries = [];
    }
}

// Append the new enquiry and save back to file
$enquiries[] = $newEnquiry;
file_put_contents($enquiriesFile, json_encode($enquiries, JSON_PRETTY_PRINT));

// Redirect to a thank-you message on the volunteer page
header("Location: ../volunteer.php?enquiry=success&name=" . urlencode($fullName));
exit();
?>