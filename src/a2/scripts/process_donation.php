<?php
// Only run this script if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Clean user input to remove unsafe or unwanted characters
    // This helps prevent basic injection / malformed data
    $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $amount    = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $method    = htmlspecialchars(strip_tags($_POST['paymentMethod']));
    $message   = htmlspecialchars(strip_tags($_POST['message']));

    // Create the data bundle
    $newDonation = [
        "firstname" => $firstname,
        "email"     => $email,
        "amount"    => $amount,
        "method"    => $method,
        "message"   => $message,
        "date"      => date("Y-m-d H:i:s") // Adds a timestamp!
    ];

    // Persistence by saving to json file
    $file = __DIR__ . '/donations.json';

    // Get existing data from the file
    $currentData = file_get_contents($file);
    $arrayData = json_decode($currentData, true);

    // Ensure we are working with an array before adding new data
    if (!is_array($arrayData)) {
        $arrayData = [];
    }

    // Add the new donation to the list
    $arrayData[] = $newDonation;

    // Save updated donation list back into the JSON file
    file_put_contents($file, json_encode($arrayData, JSON_PRETTY_PRINT));

    // Redirect user back to donation page with success message
    header("Location: ../donate.php?status=success");
    exit();
}
