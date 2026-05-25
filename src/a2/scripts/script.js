document.addEventListener("DOMContentLoaded", () => {
  // --- SLIDESHOW ---
  const slides = document.querySelectorAll(".slide-item");
  const nextBtn = document.querySelector(".next");
  const prevBtn = document.querySelector(".prev");
  let currentSlide = 0;

  // Only run slideshow if elements exist on the page
  if (nextBtn && prevBtn && slides.length > 0) {
    // Switches active slide based on index
    function showSlide(index) {
      slides[currentSlide].classList.remove("active");
      currentSlide = (index + slides.length) % slides.length;
      slides[currentSlide].classList.add("active");
    }

    nextBtn.addEventListener("click", () => showSlide(currentSlide + 1));
    prevBtn.addEventListener("click", () => showSlide(currentSlide - 1));
  }

  // --- MOBILE NAV MENU TOGGLE ---
  const menuToggle = document.getElementById("menu-toggle");
  const mainNav = document.querySelector(".main-navigation");

  if (menuToggle && mainNav) {
    menuToggle.addEventListener("click", () => {
      mainNav.classList.toggle("show");
    });
  }

  // --- FILTER DROPDOWN TOGGLE ---
  const filterToggle = document.getElementById("filter-toggle");
  const filterDropdown = document.getElementById("filter-dropdown");

  if (filterToggle && filterDropdown) {
    filterToggle.addEventListener("click", () => {
      filterDropdown.classList.toggle("show");
    });
  }

  // Close menus when clicking outside the menu box area
  document.addEventListener("click", function (event) {
    // Handle navigation menu closing
    if (mainNav && mainNav.classList.contains("show")) {
      if (!mainNav.contains(event.target) && event.target !== menuToggle) {
        mainNav.classList.remove("show");
      }
    }

    // Close filter dropdown if clicking outside
    if (filterDropdown && filterDropdown.classList.contains("show")) {
      if (
        !filterDropdown.contains(event.target) &&
        event.target !== filterToggle
      ) {
        filterDropdown.classList.remove("show");
      }
    }
  });

  // --- DONATION FORM VALIDATION ---
  const donationForm = document.querySelector(
    'form[action="scripts/process_donation.php"]',
  );
  const amountInput = document.getElementById("amount");

  if (donationForm && amountInput) {
    donationForm.addEventListener("submit", function (event) {
      const amountValue = parseFloat(amountInput.value);

      // Block invalid donation amounts (0, negative, or not a number)
      if (isNaN(amountValue) || amountValue <= 0) {
        // Stop the form from submitting to PHP
        event.preventDefault();

        // Make the border red and thick
        amountInput.style.border = "2px solid #e74c3c";
        amountInput.style.backgroundColor = "#fdecea";

        // Inform the user
        alert("Invalid Donation: Please enter an amount greater than $0.");

        // Put the cursor back in the box for them
        amountInput.focus();
      } else {
        // Reset styling if input becomes valid again
        amountInput.style.border = "";
        amountInput.style.backgroundColor = "";
      }
    });
  }

  // --- ADMIN SUCCESS BANNER ---
  const adminBanner = document.getElementById("admin-banner");

  if (adminBanner) {
    // Clean the URL so refreshing the page doesn't re-trigger the banner. This was an optional choice.
    if (window.history.replaceState) {
      window.history.replaceState({}, document.title, window.location.pathname);
    }
    // Automatically dismiss the banner after 4 seconds with a fade
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
        rows.forEach((row) => {
          if (row.dataset.petName === petName) {
            row.classList.add("row-highlight");
          }
        });
      }
    }
  }

  // --- VOLUNTEER PAGE SEARCH and FILTER ---
  const volunteerSearch = document.getElementById("volunteer-search");
  const volunteerSearchBtn = document.getElementById("volunteer-search-btn");
  const volunteerApplyBtn = document.getElementById("volunteer-apply-filters");
  const volunteerCards = document.querySelectorAll(".volunteer-job-card");
  const volunteerFilters = document.querySelectorAll(".volunteer-filter");

  // Only run on the volunteer page (where these elements exist)
  if (volunteerCards.length > 0) {
    function filterVolunteerJobs() {
      const searchText = volunteerSearch.value.toLowerCase().trim();

      // Build an array of all checked filter values
      const checkedCategories = [];
      volunteerFilters.forEach((cb) => {
        if (cb.checked) {
          checkedCategories.push(cb.value);
        }
      });

      let visibleCount = 0;

      volunteerCards.forEach((card) => {
        // Get the text content we want to search through
        const title = card
          .querySelector(".volunteer-job-title")
          .textContent.toLowerCase();
        const body = card
          .querySelector(".volunteer-job-body")
          .textContent.toLowerCase();
        const category = card.dataset.category || "";

        // Check 1 if it does or doesn't match the search text
        let matchesSearch = true;
        if (searchText !== "") {
          matchesSearch =
            title.includes(searchText) || body.includes(searchText);
        }

        // Check to see if it does or doesn't match any checked filter or even logic
        let matchesFilter = true;
        if (checkedCategories.length > 0) {
          matchesFilter = false;
          for (let i = 0; i < checkedCategories.length; i++) {
            if (category.includes(checkedCategories[i])) {
              matchesFilter = true;
              break;
            }
          }
        }

        // Show card only if both checks pass
        if (matchesSearch && matchesFilter) {
          card.classList.remove("hidden");
          visibleCount++;
        } else {
          card.classList.add("hidden");
        }
      });

      // Add or remove "no results" message
      let noResultsMsg = document.getElementById("volunteer-no-results");
      if (visibleCount === 0) {
        if (!noResultsMsg) {
          noResultsMsg = document.createElement("p");
          noResultsMsg.id = "volunteer-no-results";
          noResultsMsg.className = "volunteer-no-results";
          noResultsMsg.textContent =
            "No volunteer roles matched your search or filters.";
          document
            .querySelector(".volunteer-jobs-container")
            .appendChild(noResultsMsg);
        }
      } else {
        if (noResultsMsg) {
          noResultsMsg.remove();
        }
      }
    }

    // Filter when Search button is clicked
    if (volunteerSearchBtn) {
      volunteerSearchBtn.addEventListener("click", filterVolunteerJobs);
    }

    // Filter when Apply Filters button is clicked
    if (volunteerApplyBtn) {
      volunteerApplyBtn.addEventListener("click", filterVolunteerJobs);
    }

    // Also filter live as user types
    if (volunteerSearch) {
      volunteerSearch.addEventListener("input", filterVolunteerJobs);
    }

    // Clear all filters button
    const volunteerClearBtn = document.getElementById(
      "volunteer-clear-filters",
    );
    if (volunteerClearBtn) {
      volunteerClearBtn.addEventListener("click", () => {
        // Clear the search input
        volunteerSearch.value = "";
        // Uncheck all filter checkboxes
        volunteerFilters.forEach((cb) => (cb.checked = false));
        // Re-run the filter (which will now show everything)
        filterVolunteerJobs();
      });
    }
  }
});
