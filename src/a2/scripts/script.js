document.addEventListener("DOMContentLoaded", () => {
  // --- 1. SLIDESHOW LOGIC ---
  const slides = document.querySelectorAll(".slide-item");
  const nextBtn = document.querySelector(".next");
  const prevBtn = document.querySelector(".prev");
  let currentSlide = 0;

  // Safety Check: Only run slideshow code if the buttons actually exist on the page
  if (nextBtn && prevBtn && slides.length > 0) {
    function showSlide(index) {
      slides[currentSlide].classList.remove("active");
      currentSlide = (index + slides.length) % slides.length;
      slides[currentSlide].classList.add("active");
    }

    nextBtn.addEventListener("click", () => showSlide(currentSlide + 1));
    prevBtn.addEventListener("click", () => showSlide(currentSlide - 1));
  }

  // --- 2. MENU TOGGLE LOGIC ---
  const menuToggle = document.getElementById("menu-toggle");
  const mainNav = document.querySelector(".main-navigation");

  if (menuToggle && mainNav) {
    menuToggle.addEventListener("click", () => {
      mainNav.classList.toggle("show");
    });
  }

  // --- 3. FILTER TOGGLE LOGIC (NEW) ---
  const filterToggle = document.getElementById("filter-toggle");
  const filterDropdown = document.getElementById("filter-dropdown");

  if (filterToggle && filterDropdown) {
    filterToggle.addEventListener("click", () => {
      filterDropdown.classList.toggle("show");
    });
  }

  // --- 4. GLOBAL CLICK-OUTSIDE LOGIC ---
  document.addEventListener("click", function (event) {
    // Handle Navigation Menu Close
    if (mainNav && mainNav.classList.contains("show")) {
      if (!mainNav.contains(event.target) && event.target !== menuToggle) {
        mainNav.classList.remove("show");
      }
    }

    // Handle Filter Dropdown Close (NEW)
    if (filterDropdown && filterDropdown.classList.contains("show")) {
      if (!filterDropdown.contains(event.target) && event.target !== filterToggle) {
        filterDropdown.classList.remove("show");
      }
    }
  });

  // --- 5. DONATION FORM VALIDATION (ACTIVE JS) ---
  const donationForm = document.querySelector('form[action="scripts/process_donation.php"]');
  const amountInput = document.getElementById("amount");

  if (donationForm && amountInput) {
    donationForm.addEventListener("submit", function (event) {
      const amountValue = parseFloat(amountInput.value);

      // Check if amount is 0, negative, or not a number
      if (isNaN(amountValue) || amountValue <= 0) {
        // 1. Stop the form from submitting to PHP
        event.preventDefault();

        // 2. Visual Feedback: Make the border red and thick
        amountInput.style.border = "2px solid #e74c3c";
        amountInput.style.backgroundColor = "#fdecea";

        // 3. Inform the user
        alert("Invalid Donation: Please enter an amount greater than $0.");
        
        // 4. Put the cursor back in the box for them
        amountInput.focus();
      } else {
        // Reset styles if they fix the mistake and try again
        amountInput.style.border = "";
        amountInput.style.backgroundColor = "";
      }
    });
  }

  // --- 6. ADMIN BANNER AUTO-DISMISS + ROW HIGHLIGHT ---
  const adminBanner = document.getElementById("admin-banner");

  if (adminBanner) {
    // Auto-dismiss the banner after 4 seconds with a fade
    setTimeout(() => {
      adminBanner.classList.add("banner-fade-out");
      // After fade animation completes, hide it entirely
      setTimeout(() => {
        adminBanner.style.display = "none";
      }, 500);
    }, 4000);

    // Highlight the matching row if the banner is a "success" (added pet)
    if (adminBanner.classList.contains("banner-success")) {
      // Get pet name from the banner text
      const params = new URLSearchParams(window.location.search);
      const petName = params.get("name");

      if (petName) {
        const rows = document.querySelectorAll("tbody tr[data-pet-name]");
        rows.forEach(row => {
          if (row.dataset.petName === petName) {
            row.classList.add("row-highlight");
          }
        });
      }
    }
  }
});