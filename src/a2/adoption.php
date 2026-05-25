<?php
// Load pet data from JSON
$petsFile = __DIR__ . '/data/pets.json';
$pets = [];
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
    if (!is_array($pets)) {
        $pets = [];
    }
}

// Read the search term from URL (if any)
$searchTerm = trim($_GET['search'] ?? '');
$filteredPets = $pets; // Start with all pets

if ($searchTerm !== '') {
    // Split the search into individual keywords, lowercase, remove empties
    $keywords = preg_split('/\s+/', strtolower($searchTerm));
    $keywords = array_filter($keywords, function ($word) {
        return strlen($word) >= 2; // Ignore single characters
    });

    // Filter pets — keep any pet where at least one keyword matches
    $filteredPets = array_filter($pets, function ($pet) use ($keywords) {
        // Build a searchable text string from the pet's fields
        $searchable = strtolower(
            $pet['name'] . ' ' .
                $pet['breed'] . ' ' .
                $pet['gender'] . ' ' .
                $pet['age'] . ' ' .
                ($pet['colour'] ?? '')
        );

        // OR logic: return true if ANY keyword is found
        foreach ($keywords as $word) {
            if (strpos($searchable, $word) !== false) {
                return true;
            }
        }
        return false;
    });

    // Reindex the array (good practice after array_filter)
    $filteredPets = array_values($filteredPets);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Matic - mati0046" />
    <meta name="description" content="Happy Paws Animal Shelter - Available Pets" />
    <title>Happy Paws - Available for Adoption</title>
    <link rel="stylesheet" href="styles/style.css" />
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
            <li><a href="volunteer.html">Volunteer</a></li>
            <li><a href="donate.php">Donate</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="application.php">Apply to Adopt</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="admin.php">Admin Portal</a></li>
        </ul>
    </nav>

    <main>
        <div class="search-section">
            <h2>Find Your Perfect Match</h2>
            <form action="adoption.php" method="GET" class="search-container">
                <input type="text" id="pet-search" name="search"
                    value="<?= htmlspecialchars($searchTerm) ?>"
                    placeholder="Search by breed, age, or size..." />
                <button type="submit" class="search-btn">Search</button>

                <div class="filter-wrapper">
                    <button type="button" id="filter-toggle" class="nav-btn">Filter</button>

                    <div id="filter-dropdown" class="filter-dropdown-box">
                        <h3>Additional filters</h3>
                        <div class="checkbox-grid">
                            <label><input type="checkbox" name="color[]" value="brown"> Brown</label>
                            <label><input type="checkbox" name="color[]" value="white"> White</label>
                            <label><input type="checkbox" name="color[]" value="blonde"> Blonde</label>
                            <label><input type="checkbox" name="color[]" value="black"> Black</label>
                            <label><input type="checkbox" name="color[]" value="red"> Red</label>

                            <label><input type="checkbox" name="size[]" value="small"> Small</label>
                            <label><input type="checkbox" name="size[]" value="medium"> Medium</label>
                            <label><input type="checkbox" name="size[]" value="large"> Large</label>
                            <label><input type="checkbox" name="age[]" value="baby"> Baby</label>
                            <label><input type="checkbox" name="age[]" value="senior"> Senior</label>
                        </div>
                        <button type="submit" class="apply-filters-btn">Apply Filter(s)</button>
                    </div>
                </div>
            </form>
        </div>

        <?php if ($searchTerm !== ''): ?>
            <p class="search-results-info">
                Showing results for: <strong>"<?= htmlspecialchars($searchTerm) ?>"</strong>
                — <a href="adoption.php">Clear search</a>
            </p>
        <?php endif; ?>

        <section class="pet-display-container">
            <?php if (empty($filteredPets)): ?>
                <?php if ($searchTerm !== ''): ?>
                    <p class="no-results-message">
                        Sorry, no pets matched your search for "<strong><?= htmlspecialchars($searchTerm) ?></strong>".
                        <br>Try different keywords, or <a href="adoption.php">view all pets</a>.
                    </p>
                <?php else: ?>
                    <p>No pets available at the moment. Please check back soon!</p>
                <?php endif; ?>
            <?php else: ?>
                <?php foreach ($filteredPets as $pet): ?>
                    <article class="pet-card">
                        <h3 class="pet-card-name"><?= htmlspecialchars($pet['name']) ?></h3>
                        <div class="pet-image-container">
                            <img src="images/<?= htmlspecialchars($pet['image']) ?>"
                                alt="<?= htmlspecialchars($pet['name']) ?> - <?= htmlspecialchars($pet['breed']) ?>"
                                class="pet-card-img">
                        </div>
                        <div class="pet-card-details">
                            <p><strong>Age:</strong> <?= htmlspecialchars($pet['age']) ?></p>
                            <p><strong>Gender:</strong> <?= htmlspecialchars($pet['gender']) ?></p>
                            <p><strong>Breed:</strong> <?= htmlspecialchars($pet['breed']) ?></p>
                            <p><strong>Price:</strong> $<?= htmlspecialchars($pet['price']) ?></p>
                            <a href="pet-details.php?id=<?= $pet['id'] ?>" class="view-profile-btn">View Full Profile</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
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