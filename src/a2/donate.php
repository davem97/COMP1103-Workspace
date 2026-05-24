<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="author" content="David Matic - mati0046" />
  <meta name="description" content="Happy Paws Animal Shelter Homepage" />

  <title>Happy Paws - Donate</title>
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
      <li><a href="adoption.html">Available Pets</a></li>
      <li><a href="volunteer.html">Available Pets</a></li>
      <li><a href="donate.php">Donate</a></li>
      <li><a href="feedback.html">Available Pets</a></li>
      <li><a href="application.html">Apply to Adopt</a></li>
      <li><a href="about.html">About Us</a></li>
      <li><a href="admin.html">Admin Portal</a></li>
    </ul>
  </nav>
  <main>
    <h2>Support Our Mission</h2>
    <p class="donation-disclaimer"><em>Note: This is a prototype for a student project. No real payments are
        processed.</em></p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div
        style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
        <strong>Thank you!</strong> Your donation has been recorded successfully.
      </div>
    <?php endif; ?>

    <form method="POST" action="scripts/process_donation.php">
      <fieldset>
        <legend>Your Details</legend>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="email">Email address:</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required>
      </fieldset>

      <fieldset>
        <legend>Donation Info</legend>

        <label for="amount">Donation Amount ($):</label>
        <input type="number" id="amount" name="amount" min="1" step="0.01" placeholder="e.g. 25.00" required>

        <label for="payment-method">Payment Method:</label>
        <select id="payment-method" name="paymentMethod">
          <option value="credit-card">Credit Card</option>
          <option value="paypal">PayPal</option>
          <option value="bank-transfer">Direct Bank Transfer</option>
        </select>

        <label for="message">Optional Message:</label>
        <textarea id="message" name="message" rows="4" placeholder="Would you like to leave a note?"></textarea>
      </fieldset>

      <input type="submit" id="submit" name="submit" value="Complete Donation">
    </form>
  </main>

  <footer>
    <p>© 2026 Happy Paws Shelter</p>
  </footer>
</body>

</html>