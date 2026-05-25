<?php
// Pre-fill the role field from URL parameter (passed from volunteer.php buttons)
$role = htmlspecialchars($_GET['role'] ?? '');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Matic - mati0046" />
    <meta name="description" content="Happy Paws Animal Shelter - Volunteer Role Enquiry" />
    <title>Happy Paws - Enquire About Volunteering</title>
    <link rel="stylesheet" href="styles/style.css" />
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
        <h2>Volunteer Enquiry</h2>

        <?php if ($role !== ''): ?>
            <p class="application-prefill-note">
                You are enquiring about: <strong><?= $role ?></strong>
            </p>
        <?php endif; ?>

        <form action="scripts/process_enquiry.php" method="POST">
            <fieldset>
                <legend>Your Details</legend>

                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" required>

                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" required>
            </fieldset>

            <fieldset>
                <legend>Enquiry Details</legend>

                <!-- Hidden field passes the role from the URL into the form -->
                <input type="hidden" name="role" value="<?= $role ?: 'General Enquiry' ?>">

                <label for="message">Message (optional)</label>
                <textarea id="message" name="message" rows="5"
                    placeholder="Tell us anything else you'd like us to know..."></textarea>
            </fieldset>

            <input type="submit" value="Submit Enquiry">
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