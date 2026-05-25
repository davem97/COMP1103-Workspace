<?php
// Load pet data
$petsFile = __DIR__ . '/data/pets.json';
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Get the pet ID from the URL (?id=X) and find the matching pet
$requestedId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$pet = null;
foreach ($pets as $p) {
    if ($p['id'] === $requestedId) {
        $pet = $p;
        break;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Matic - mati0046" />
    <meta name="description" content="Happy Paws Animal Shelter - Pet Profile" />
    <title>
        <?= $pet ? 'Happy Paws - ' . htmlspecialchars($pet['name']) : 'Happy Paws - Pet Not Found' ?>
    </title>
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
        <!-- Show either a "not found" message or the full pet profile depending on whether the pet exists !-->
        <?php if ($pet === null): ?>
            <!-- Message shown when the requested pet ID does not exist -->
            <section class="pet-profile">
                <h2>Pet Not Found</h2>
                <p>Sorry, we couldn't find that pet. They may have already found their forever home!</p>
                <a href="adoption.php" class="view-profile-btn">Back to All Pets</a>
            </section>
        <?php else: ?>
            <section class="pet-profile">
                <h2><?= htmlspecialchars($pet['name']) ?></h2>

                <div class="pet-profile-image">
                    <img src="images/<?= htmlspecialchars($pet['image']) ?>"
                        alt="<?= htmlspecialchars($pet['name']) ?> - <?= htmlspecialchars($pet['breed']) ?>">
                </div>

                <div class="pet-profile-info">
                    <div class="pet-profile-info-inner">
                        <p><strong>Age:</strong> <?= htmlspecialchars($pet['age']) ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($pet['gender']) ?></p>
                        <p><strong>Breed:</strong> <?= htmlspecialchars($pet['breed']) ?></p>
                        <p><strong>Price:</strong> $<?= htmlspecialchars($pet['price']) ?></p>
                        <p><strong>Microchip:</strong> <?= htmlspecialchars($pet['microchip']) ?></p>
                        <p><strong>Tag:</strong> <?= htmlspecialchars($pet['tag']) ?></p>
                        <p><strong>Source Number:</strong> <?= htmlspecialchars($pet['sourceNumber']) ?></p>
                    </div>
                </div>

                <!-- Extra pet information (only shown if it exists in the data) -->
                <section class="pet-additional-info">
                    <h3>Additional Information</h3>

                    <?php if (!empty($pet['additionalInfo']) && is_array($pet['additionalInfo'])): ?>
                        <?php $info = $pet['additionalInfo']; ?>

                        <?php if (!empty($info['paragraphs'])): ?>
                            <?php foreach ($info['paragraphs'] as $paragraph): ?>
                                <p><?= htmlspecialchars($paragraph) ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($info['moreInfo'])): ?>
                            <p class="more-info-heading">More information:</p>
                            <ul class="more-info-list">
                                <?php foreach ($info['moreInfo'] as $label => $value): ?>
                                    <li><strong><?= htmlspecialchars($label) ?></strong> - <?= htmlspecialchars($value) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($info['closing'])): ?>
                            <p><?= htmlspecialchars($info['closing']) ?></p>
                        <?php endif; ?>

                    <?php else: ?>
                        <p>No additional information available for this pet.</p>
                    <?php endif; ?>
                </section>

                <div class="pet-profile-actions">
                    <a href="adoption.php" class="profile-btn back-btn">&larr; Back to All Pets</a>
                    <a href="application.php?pet=<?= urlencode($pet['name']) ?>&id=<?= $pet['id'] ?>"
                        class="profile-btn apply-btn">Apply to Adopt <?= htmlspecialchars($pet['name']) ?></a>
                    <button type="button" class="profile-btn share-btn" id="share-btn">Share</button>
                </div>

                <p id="share-feedback" class="share-feedback" aria-live="polite"></p>

                <!-- Displays additional pet images if they are available -->
                <?php if (!empty($pet['extraImages']) && is_array($pet['extraImages'])): ?>
                    <div class="pet-extra-images">
                        <?php foreach ($pet['extraImages'] as $extraImg): ?>
                            <img src="images/<?= htmlspecialchars($extraImg) ?>"
                                alt="Additional photo of <?= htmlspecialchars($pet['name']) ?>"
                                class="pet-extra-img">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>
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
    <script>
        // Share button: copies the current URL to clipboard
        const shareBtn = document.getElementById('share-btn');
        const shareFeedback = document.getElementById('share-feedback');

        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(window.location.href);
                    shareFeedback.textContent = '✓ Link copied to clipboard!';
                } catch (err) {
                    shareFeedback.textContent = 'Could not copy. URL: ' + window.location.href;
                }
                setTimeout(() => {
                    shareFeedback.textContent = '';
                }, 3000);
            });
        }
    </script>
</body>

</html>