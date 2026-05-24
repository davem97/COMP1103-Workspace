<?php
// 1. Check if the form was actually submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. SANITIZATION (The "Security" Requirement)
    // We "scrub" the data to prevent malicious code injection
    $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $amount    = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $method    = htmlspecialchars(strip_tags($_POST['paymentMethod']));
    $message   = htmlspecialchars(strip_tags($_POST['message']));

    // 3. Create the data bundle
    $newDonation = [
        "firstname" => $firstname,
        "email"     => $email,
        "amount"    => $amount,
        "method"    => $method,
        "message"   => $message,
        "date"      => date("Y-m-d H:i:s") // Adds a timestamp!
    ];

    // 4. PERSISTENCE (Saving to JSON)
    $file = __DIR__ . '/donations.json';

    // Get existing data from the file
    $currentData = file_get_contents($file);
    $arrayData = json_decode($currentData, true);

    // If the file was empty or broken, start a fresh array
    if (!is_array($arrayData)) {
        $arrayData = [];
    }

    // Add the new donation to the list
    $arrayData[] = $newDonation;

    // Save the updated list back to the file
    file_put_contents($file, json_encode($arrayData, JSON_PRETTY_PRINT));

    // 5. Redirect the user back to a "Thank You" message
    // For now, let's just send them back to the donation page
    header("Location: ../donate.php?status=success");
    exit();
}
?>