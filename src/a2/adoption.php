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

// Read the search term and filters from URL (if any)
$searchTerm    = trim($_GET['search'] ?? '');
$colourFilter  = $_GET['color'] ?? [];  // array of checked colours
$sizeFilter    = $_GET['size'] ?? [];   // array of checked sizes
$ageFilter     = $_GET['age'] ?? [];    // array of checked age categories

// Normalize filter values to lowercase for case-insensitive matching
$colourFilter = array_map('strtolower', (array)$colourFilter);
$sizeFilter   = array_map('strtolower', (array)$sizeFilter);
$ageFilter    = array_map('strtolower', (array)$ageFilter);

// Helper: figure out if a pet's age text means "baby" or "senior"
function getAgeCategory($ageText)
{
    $ageText = strtolower($ageText);
    // "Baby" = anything in months OR explicitly "1 year" or under
    if (strpos($ageText, 'month') !== false) return 'baby';
    // "Senior" = 7+ years (cats/dogs senior thresholds vary, 7 is common)
    if (preg_match('/(\d+)\s*year/', $ageText, $match)) {
        $years = (int)$match[1];
        if ($years >= 7) return 'senior';
    }
    return 'adult';
}

// Start with all pets, then narrow down
$filteredPets = $pets;

// === Stage 1: Keyword search ===
if ($searchTerm !== '') {
    $keywords = preg_split('/\s+/', strtolower($searchTerm));
    $keywords = array_filter($keywords, function ($word) {
        return strlen($word) >= 2;
    });

    $filteredPets = array_filter($filteredPets, function ($pet) use ($keywords) {
        $searchable = strtolower(
            $pet['name'] . ' ' .
                $pet['breed'] . ' ' .
                $pet['gender'] . ' ' .
                $pet['age'] . ' ' .
                ($pet['colour'] ?? '') . ' ' .
                ($pet['size'] ?? '')
        );

        foreach ($keywords as $word) {
            if (strpos($searchable, $word) !== false) {
                return true;
            }
        }
        return false;
    });
}

// === Stage 2: Colour filter (OR within category) ===
if (!empty($colourFilter)) {
    $filteredPets = array_filter($filteredPets, function ($pet) use ($colourFilter) {
        $petColour = strtolower($pet['colour'] ?? '');
        foreach ($colourFilter as $checkedColour) {
            if (strpos($petColour, $checkedColour) !== false) {
                return true;
            }
        }
        return false;
    });
}

// === Stage 3: Size filter ===
if (!empty($sizeFilter)) {
    $filteredPets = array_filter($filteredPets, function ($pet) use ($sizeFilter) {
        $petSize = strtolower($pet['size'] ?? '');
        return in_array($petSize, $sizeFilter);
    });
}

// === Stage 4: Age category filter ===
if (!empty($ageFilter)) {
    $filteredPets = array_filter($filteredPets, function ($pet) use ($ageFilter) {
        $category = getAgeCategory($pet['age']);
        return in_array($category, $ageFilter);
    });
}

// Reindex the array (good practice after array_filter)
$filteredPets = array_values($filteredPets);

// Are any filters or search active? (used to decide whether to show banner)
$hasActiveFilters = $searchTerm !== '' || !empty($colourFilter) || !empty($sizeFilter) || !empty($ageFilter);
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
                            <label><input type="checkbox" name="color[]" value="brown" <?= in_array('brown',  $colourFilter) ? 'checked' : '' ?>> Brown</label>
                            <label><input type="checkbox" name="color[]" value="white" <?= in_array('white',  $colourFilter) ? 'checked' : '' ?>> White</label>
                            <label><input type="checkbox" name="color[]" value="blonde" <?= in_array('blonde', $colourFilter) ? 'checked' : '' ?>> Blonde</label>
                            <label><input type="checkbox" name="color[]" value="black" <?= in_array('black',  $colourFilter) ? 'checked' : '' ?>> Black</label>
                            <label><input type="checkbox" name="color[]" value="red" <?= in_array('red',    $colourFilter) ? 'checked' : '' ?>> Red</label>

                            <label><input type="checkbox" name="size[]" value="small" <?= in_array('small',  $sizeFilter) ? 'checked' : '' ?>> Small</label>
                            <label><input type="checkbox" name="size[]" value="medium" <?= in_array('medium', $sizeFilter) ? 'checked' : '' ?>> Medium</label>
                            <label><input type="checkbox" name="size[]" value="large" <?= in_array('large',  $sizeFilter) ? 'checked' : '' ?>> Large</label>
                            <label><input type="checkbox" name="age[]" value="baby" <?= in_array('baby',   $ageFilter)    ? 'checked' : '' ?>> Baby</label>
                            <label><input type="checkbox" name="age[]" value="senior" <?= in_array('senior', $ageFilter)    ? 'checked' : '' ?>> Senior</label>
                        </div>
                        <button type="submit" class="apply-filters-btn">Apply Filter(s)</button>
                    </div>
                </div>
            </form>
        </div>

        <?php if ($hasActiveFilters): ?>
            <p class="search-results-info">
                <?php if ($searchTerm !== ''): ?>
                    Showing results for: <strong>"<?= htmlspecialchars($searchTerm) ?>"</strong>
                <?php else: ?>
                    Showing filtered results
                <?php endif; ?>
                — <a href="adoption.php">Clear all filters</a>
            </p>
        <?php endif; ?>

        <section class="pet-display-container">
            <?php if (empty($filteredPets)): ?>
                <?php if ($hasActiveFilters): ?>
                    <p class="no-results-message">
                        Sorry, no pets matched your search or filters.
                        <br>Try different criteria, or <a href="adoption.php">view all pets</a>.
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