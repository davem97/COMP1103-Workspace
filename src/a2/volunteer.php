<?php
// We'll keep the PHP structure in case you want to pull volunteer data from JSON later
// For now, we will hard-code the 3 roles for simplicity as discussed.
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="David Matic - mati0046" />
    <meta name="description" content="Happy Paws Animal Shelter - Volunteer Opportunities" />
    <title>Happy Paws - Volunteer With Us</title>
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
            <li><a href="volunteer.php">Volunteer</a></li>
            <li><a href="donate.php">Donate</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="application.php">Apply to Adopt</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="admin.php">Admin Portal</a></li>
        </ul>
    </nav>

    <main>
        <section class="volunteer-intro" style="padding: 20px; text-align: center;">
            <h2>Volunteer With Us</h2>

            <!-- Section 1: Single centered box with side images -->
            <div class="purpose-with-images">
                <img src="images/volunteer_img1.png" alt="Volunteers helping animals" class="purpose-side-img purpose-img-left">

                <section class="volunteer-section single">
                    <div class="volunteer-header-box">
                        <h3>Our Purpose</h3>
                    </div>
                    <p class="volunteer-text">
                        At Happy Paws, we believe every animal deserves love, care, and a forever home.
                        Our volunteers are the heart of everything we do — from walking dogs and socialising
                        cats, to running adoption events and helping with day-to-day care. Whether you have
                        a few hours a week or a full day to spare, your time can make a lasting difference
                        in the lives of the animals waiting for their second chance.
                    </p>
                </section>

                <img src="images/volunteer_img2.png" alt="A happy volunteer with a pet" class="purpose-side-img purpose-img-right">
            </div>

            <!-- Section 2: Two side-by-side boxes -->
            <section class="volunteer-pair">
                <div class="volunteer-section">
                    <div class="volunteer-header-box">
                        <h3>Help us Make a Difference</h3>
                    </div>
                    <p class="volunteer-text">
                        Volunteering at Happy Paws is rewarding, hands-on, and flexible. You'll work
                        alongside experienced staff to provide care, comfort and enrichment to animals
                        of all shapes and sizes. No prior experience is needed — just enthusiasm and
                        a love for animals.
                    </p>
                </div>

                <div class="volunteer-section">
                    <div class="volunteer-header-box">
                        <h3>What You'll Gain</h3>
                    </div>
                    <p class="volunteer-text">
                        Beyond the joy of working with animals, our volunteers receive professional
                        training, references for future employment, and access to community events.
                        It's a great way to build skills, meet like-minded people, and contribute to
                        a cause that matters.
                    </p>
                </div>
            </section>
        </section>

        <div class="search-section">
            <h2>Find the Right Volunteer Role</h2>
            <div class="search-container">
                <input type="text" id="volunteer-search" placeholder="Search roles (e.g. 'foster', 'cleaning')..." />
                <button type="button" class="search-btn" id="volunteer-search-btn">Search</button>

                <div class="filter-wrapper">
                    <button type="button" id="filter-toggle" class="nav-btn">Filter</button>
                    <div id="filter-dropdown" class="filter-dropdown-box">
                        <h3>Role Categories</h3>
                        <div class="checkbox-grid">
                            <label><input type="checkbox" class="volunteer-filter" value="animal care"> Animal Care</label>
                            <label><input type="checkbox" class="volunteer-filter" value="administration"> Administration</label>
                            <label><input type="checkbox" class="volunteer-filter" value="events"> Events</label>
                            <label><input type="checkbox" class="volunteer-filter" value="cleaning"> Cleaning</label>
                            <label><input type="checkbox" class="volunteer-filter" value="maintenance"> Maintenance</label>
                        </div>
                        <div class="filter-buttons">
                            <button type="button" class="apply-filters-btn" id="volunteer-apply-filters">Apply Filter(s)</button>
                            <button type="button" class="clear-filters-btn" id="volunteer-clear-filters">Clear All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="volunteer-jobs-container">

            <article class="volunteer-job-card" data-category="animal care">
                <h3 class="volunteer-job-title">Foster Care</h3>
                <div class="volunteer-job-body">
                    <p>Open your home to a pet in transition. We provide the food and medical care; you provide the love and a warm bed until they find a permanent home.</p>
                    <p><strong>Commitment:</strong> Flexible, usually 2–8 weeks per pet.</p>
                    <p><strong>Suits:</strong> Animal lovers with a quiet home environment.</p>
                </div>
                <div class="volunteer-job-action">
                    <button type="button" class="profile-btn apply-btn">Enquire Now</button>
                </div>
            </article>

            <article class="volunteer-job-card" data-category="events">
                <h3 class="volunteer-job-title">Event Help</h3>
                <div class="volunteer-job-body">
                    <p>Help us at adoption days, community fundraisers, and local markets. Perfect for social people who want to advocate for our animals in public.</p>
                    <p><strong>Commitment:</strong> One Saturday per month, ~4 hours.</p>
                    <p><strong>Suits:</strong> Outgoing, confident communicators.</p>
                </div>
                <div class="volunteer-job-action">
                    <button type="button" class="profile-btn apply-btn">Enquire Now</button>
                </div>
            </article>

            <article class="volunteer-job-card" data-category="cleaning maintenance">
                <h3 class="volunteer-job-title">Shelter Support</h3>
                <div class="volunteer-job-body">
                    <p>Keep our facility running smoothly. This includes kennel cleaning, laundry, gardening, and general repairs to keep the animals safe and happy.</p>
                    <p><strong>Commitment:</strong> Weekly, 3–6 hours.</p>
                    <p><strong>Suits:</strong> Hands-on people who like physical work.</p>
                </div>
                <div class="volunteer-job-action">
                    <button type="button" class="profile-btn apply-btn">Enquire Now</button>
                </div>
            </article>

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