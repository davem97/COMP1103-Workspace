<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
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
    <meta name="description" content="Happy Paws Animal Shelter - Add Pet" />
    <title>Happy Paws - Add Pet</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header>
        <nav class="top-nav">
            <button class="nav-btn" id="menu-toggle">Menu</button>
            <div class="logo-wrap">
                <img src="images/happy_paws_logo.png" alt="Happy Paws Animal Shelter main logo" class="main-logo-img" />
            </div>
            <button class="nav-btn donate">Donate</button>
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
        <h2>Add New Pet</h2>

        <form method="POST" action="scripts/process_add_pet.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Basic Details</legend>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="breed">Breed:</label>
                <input type="text" id="breed" name="breed" required>

                <label for="age">Age:</label>
                <input type="text" id="age" name="age" placeholder="e.g. 2 years" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required>
            </fieldset>

            <fieldset>
                <legend>Identification</legend>

                <label for="microchip">Microchip Number:</label>
                <input type="text" id="microchip" name="microchip" required>

                <label for="tag">Tag:</label>
                <input type="text" id="tag" name="tag" placeholder="e.g. HP-007" required>

                <label for="sourceNumber">Source Number:</label>
                <input type="text" id="sourceNumber" name="sourceNumber" placeholder="e.g. VB12351" required>
            </fieldset>

            <fieldset>
                <legend>Additional Info</legend>

                <label for="kids">Suitable for kids:</label>
                <input type="text" id="kids" name="kids" placeholder="e.g. 10+ or All ages" required>

                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" placeholder="e.g. 14.9 kgs" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="6" placeholder="Tell us about this pet..." required></textarea>
            </fieldset>

            <fieldset>
                <legend>Pet Photos</legend>

                <label for="main_image">Main Photo:</label>
                <input type="file" id="main_image" name="main_image" accept="image/*" required>

                <label for="extra_image_1">Additional Photo #1:</label>
                <input type="file" id="extra_image_1" name="extra_image_1" accept="image/*">

                <label for="extra_image_2">Additional Photo #2:</label>
                <input type="file" id="extra_image_2" name="extra_image_2" accept="image/*">
            </fieldset>

            <input type="submit" value="Add Pet">
        </form>
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
                <p>
                    <a href="feedback.php" class="feedback-link"><strong>Feedback</strong></a>
                </p>
            </div>

            <p class="copyright">&copy; 2026 Happy Paws Animal Shelter</p>
        </div>
    </footer>
    <script src="scripts/script.js"></script>
</body>

</html>