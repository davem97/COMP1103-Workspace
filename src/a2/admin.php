<?php
$petsFile = __DIR__ . '/data/pets.json';
$pets = [];
if (file_exists($petsFile)) {
  $pets = json_decode(file_get_contents($petsFile), true);
}

// Read the status banner info from URL
$status = $_GET['status'] ?? '';
$petName = $_GET['name'] ?? '';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="David Matic - mati0046" />
  <meta name="description" content="Happy Paws Animal Shelter Homepage" />
  <title>Happy Paws - Admin</title>
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
      <li><a href="volunteer.html">Volunteer</a></li>
      <li><a href="donate.php">Donate</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="application.html">Apply to Adopt</a></li>
      <li><a href="about.html">About Us</a></li>
      <li><a href="admin.php">Admin Portal</a></li>
    </ul>
  </nav>

  <main>
    <h2>Administration</h2>

    <?php if ($status === 'added'): ?>
      <div class="admin-banner banner-success" id="admin-banner">
        <strong>&#10003; Success!</strong>
        <?= htmlspecialchars($petName) ?> has been added to the listing.
      </div>
    <?php elseif ($status === 'deleted'): ?>
      <div class="admin-banner banner-deleted" id="admin-banner">
        <strong>&#10003; Removed.</strong>
        <?= htmlspecialchars($petName) ?> has been removed from the listing.
      </div>
    <?php elseif ($status === 'error'): ?>
      <div class="admin-banner banner-error" id="admin-banner">
        <strong>&#9888; Something went wrong.</strong>
        Please try again.
      </div>
    <?php endif; ?>

    <div class="admin-actions">
      <a href="add_pet.php" class="nav-btn">Add New Pet Listing</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Breed</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pets as $pet): ?>
          <tr data-pet-name="<?= htmlspecialchars($pet['name']) ?>">
            <td><?= htmlspecialchars($pet['tag']) ?></td>
            <td><?= htmlspecialchars($pet['name']) ?></td>
            <td><?= htmlspecialchars($pet['breed']) ?></td>
            <td><?= htmlspecialchars($pet['additionalInfo']['moreInfo']['Status']) ?></td>
            <td>
              <a href="edit_pet.php?id=<?= $pet['id'] ?>">Edit</a> |
              <a href="scripts/delete_pet.php?id=<?= $pet['id'] ?>"
                onclick="return confirm('Are you sure you want to remove this pet?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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