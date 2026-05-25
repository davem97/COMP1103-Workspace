<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="David Matic - mati0046" />
  <meta name="description" content="Happy Paws Animal Shelter Feedback Page" />

  <title>Happy Paws - Feedback</title>
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
      <li><a href="volunteer.html">Volunteer</a></li>
      <li><a href="donate.php">Donate</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="application.php">Apply to Adopt</a></li>
      <li><a href="about.html">About Us</a></li>
      <li><a href="admin.php">Admin Portal</a></li>
    </ul>
  </nav>

  <main>
    <h2>We Value Your Feedback</h2>
    <p style="text-align: center;">Have a suggestion or a question? We’d love to hear from you!</p>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
        <strong>Thank you!</strong> Your feedback has been received and helps us help more pets.
      </div>
    <?php endif; ?>

    <form method="POST" action="scripts/process_feedback.php">
      <fieldset>
        <legend>Contact Information</legend>
        
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Contact Email:</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" required>
      </fieldset>

      <fieldset>
        <legend>Your Message</legend>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="6" placeholder="How can we improve, or what did we do well?" required></textarea>
      </fieldset>

      <input type="submit" id="submit" name="submit" value="Submit Feedback">
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

      <p class="copyright">© 2026 Happy Paws Animal Shelter</p>
    </div>
  </footer>
</body>

</html>