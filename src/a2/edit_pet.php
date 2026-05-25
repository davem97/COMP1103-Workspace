<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: admin.php");
    exit();
}

// Get pet ID from URL
$requestedId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Load pets
$petsFile = __DIR__ . '/data/pets.json';
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Find the matching pet
$pet = null;
foreach ($pets as $p) {
    if ($p['id'] === $requestedId) {
        $pet = $p;
        break;
    }
}

// If no pet found, bounce back to admin
if ($pet === null) {
    header("Location: admin.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Matic - mati0046" />
    <meta name="description" content="Happy Paws Animal Shelter - Edit Pet" />
    <title>Happy Paws - Edit <?= htmlspecialchars($pet['name']) ?></title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header>
        <nav class="top-nav">
            <button class="nav-btn" id="menu-toggle">Menu</button>
            <div class="logo-wrap">
                <img src="images/happy_paws_logo.png" alt="Happy Paws Animal Shelter main logo" class="main-logo-img" />
            </div>
            <button class="nav-btn donate" onclick="location.href='donate.php'">Donate</button>
        </nav>
        <h1 class="visually-hidden">Happy Paws Animal Shelter</h1>
    </header>

    <nav class="main-navigation">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="adoption.php">Available Pets</a></li>
            <li><a href="volunteer.php">Volunteer</a></li>
            <li><a href="donate.php">Donate</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="application.php">Apply to Adopt</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="admin.php">Admin Portal</a></li>
        </ul>
    </nav>

    <main>
        <h2>Edit Pet: <?= htmlspecialchars($pet['name']) ?></h2>

        <form method="POST" action="scripts/process_edit_pet.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Basic Details</legend>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($pet['name']) ?>" required>

                <label for="breed">Breed:</label>
                <input type="text" id="breed" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" required>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?= htmlspecialchars($pet['age']) ?>" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?= $pet['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $pet['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                </select>

                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" min="0" step="0.01"
                    value="<?= htmlspecialchars($pet['price']) ?>" required>
            </fieldset>

            <fieldset>
                <legend>Identification</legend>

                <label for="microchip">Microchip Number:</label>
                <input type="text" id="microchip" name="microchip"
                    value="<?= htmlspecialchars($pet['microchip']) ?>" required>

                <label for="tag">Tag:</label>
                <input type="text" id="tag" name="tag"
                    value="<?= htmlspecialchars($pet['tag']) ?>" required>

                <label for="sourceNumber">Source Number:</label>
                <input type="text" id="sourceNumber" name="sourceNumber"
                    value="<?= htmlspecialchars($pet['sourceNumber']) ?>" required>
            </fieldset>

            <fieldset>
                <legend>Update Photos</legend>

                <p><small>Only upload files if you want to replace the existing photos. Leave these blank to keep the current images.</small></p>

                <label for="main_image">New Main Photo:</label>
                <input type="file" id="main_image" name="main_image" accept="image/*">

                <label for="extra_image_1">New Additional Photo #1:</label>
                <input type="file" id="extra_image_1" name="extra_image_1" accept="image/*">

                <label for="extra_image_2">New Additional Photo #2:</label>
                <input type="file" id="extra_image_2" name="extra_image_2" accept="image/*">
            </fieldset>

            <fieldset>
                <legend>Additional Info</legend>

                <label for="kids">Suitable for kids:</label>
                <input type="text" id="kids" name="kids"
                    value="<?= htmlspecialchars($pet['additionalInfo']['moreInfo']['Kids'] ?? '') ?>" required>

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight"
                    value="<?= htmlspecialchars($pet['additionalInfo']['moreInfo']['Weight'] ?? '') ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="6" required><?php
                                                                                echo htmlspecialchars($pet['additionalInfo']['paragraphs'][0] ?? '');
                                                                                ?></textarea>
            </fieldset>

            <!-- Hidden field tells the handler which pet to update -->
            <input type="hidden" name="id" value="<?= $pet['id'] ?>">

            <input type="submit" value="Save Changes">
        </form>

        <p style="text-align: center; margin-top: 1.5rem;">
            <a href="admin.php">&larr; Cancel and return to admin</a>
        </p>
    </main>

    <footer>
        <hr />
        <div class="footer-content">
            <img src="images/happy_paws_logo.png" alt="Happy Paws Logo" class="footer-logo" />
            <div class="footer-section">
                <p><strong>Call</strong></p>
                <p>(03) 5555 111 222</p>
            </div>
            <address class="footer-section">
                <p><strong>Visit</strong></p>
                <p>43 PLACEHOLDER STREET</p>
                <p>MELBOURNE 3000</p>
            </address>
            <div class="footer-section">
                <p><strong>Opening Hours</strong></p>
                <p>MON - FRI: 9:30 AM - 5 PM</p>
                <p>SAT: 10 AM - 3 PM</p>
                <p>SUN: 10 AM - 2 PM</p>
            </div>
            <div class="footer-section">
                <p><a href="feedback.php" class="feedback-link"><strong>Feedback</strong></a></p>
            </div>
            <p class="copyright">&copy; 2026 Happy Paws Animal Shelter</p>
        </div>
    </footer>

    <script src="scripts/script.js"></script>
</body>

</html>