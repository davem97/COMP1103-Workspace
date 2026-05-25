<?php
// If the user clicked "Apply" from a pet's profile, these come through in the URL
$prefillPetName = $_GET['pet'] ?? '';
$prefillPetId   = $_GET['id'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Matic - mati0046">
    <meta name="description" content="Happy Paws Animal Shelter - Apply to Adopt">
    <title>Happy Paws - Apply to Adopt</title>
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
        <h2>Apply to Adopt</h2>

        <!-- Show success message after form is submitted successfully. "===" is used to show that the value must BE 'success' !-->
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
                <strong>&#10003; Thank you!</strong> Your application has been submitted. We'll be in touch soon.
            </div>
        <?php endif; ?>
        <!-- If a pet name is provided, show which pet the user is applying for via "$prefillPetName" !-->
        <?php if ($prefillPetName !== ''): ?>
            <p class="application-prefill-note">
                You're applying to adopt <strong><?= htmlspecialchars($prefillPetName) ?></strong>.
            </p>
        <?php endif; ?>

        <!-- Sends form data to the server using POST when the form is submitted -->
        <form method="POST" action="scripts/process_application.php" id="application-form">
            <!-- Using <fieldset> as common practice for information such as details -->
            <fieldset>
                <legend>Your Details</legend>
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="surname">Last Name:</label>
                <input type="text" id="surname" name="surname" required>

                <label for="email">Email address:</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>

                <label for="phone">Phone number:</label>
                <input type="tel" id="phone" name="phone" required>
            </fieldset>

            <fieldset>
                <legend>Housing Details</legend>

                <label for="housing">Housing Type:</label>
                <select id="housing" name="housing">
                    <option value="House">House</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Shared House">Shared House</option>
                </select>

                <br><br>

                <label><b>Type of yard:</b></label>
                <p><input type="radio" id="smYard" name="yardType" value="small">Small Yard</p>
                <p><input type="radio" id="lgYard" name="yardType" value="large">Large Yard</p>
                <p><input type="radio" id="noYard" name="yardType" value="none">No Yard</p>

                <label for="petExperience"><b>Previous Pet Experience:</b></label>
                <textarea id="petExperience" name="petExperience" rows="5"></textarea>
            </fieldset>

            <!-- Hidden fields carrying the pet info if user came from pet-details page -->
            <input type="hidden" name="petName" value="<?= htmlspecialchars($prefillPetName) ?>">
            <input type="hidden" name="petId" value="<?= htmlspecialchars($prefillPetId) ?>">

            <input type="submit" id="submit" name="submit" value="Submit Application">
        </form>

        <p>Welcome to Happy Paws! Our mission is to connect homeless pets with loving families. We believe every animal
            deserves a safe home and a second chance. Browse our available
            animals or submit an application today to start your adoption journey.
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