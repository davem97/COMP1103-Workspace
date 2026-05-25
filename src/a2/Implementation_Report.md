# Implementation Report: Happy Paws Animal Shelter
**Author:** David Matic (mati0046)  
**Date:** May 2026  
**Directory:** project-docs/src/A2/

---

## 1. Website Functionality & Flow
*Demonstrating the interactive features and user journey of the Happy Paws platform.*

### 1.1 Home Page (`index.php`)
The home page features a responsive hero section and a dynamic JavaScript slideshow.
![Home Page Screenshot](images/homepage.png)

**Annotations:**
1. **Horizontal Menu:** The reason for this menu style is because it brings simplicity to the website and with the users attention being directly at the center where the logo is, it creates ease of use. 
2. **Search Bar:** Large, accessible search bar to solve the user's primary intent immediately right inbetween all the content.
3. **Slideshow:** This slideshow is meant to show some of the animals that the shelter have. They can be searched for directly above in the search bar, or via the "Available Pets" menu option.
4. **Vertically stacked footer:** This is a very clean and clear way to handle all of the relevant information respective to the shelter; their phone number, address, etc. It is a common approach, brings an additional layer to the website and takes up some space. 

### 1.5 Pet Details (`pet-details.php`)
The home page features a responsive hero section and a dynamic JavaScript slideshow.
![Home Page Screenshot](images/pet-details.png)

**Annotations:**
1. **Vertical animal information:** You want the potential adoptee to immediately see the animal they are looking at. With this layout completely centered with the information immediately eye-catching in the slightly darkened grey box, all the information is processed quickly. 
2. **Additional Information:** Providing all the required and relevant information necessary about the animal. Providing as much information as possible is good because the adoptee might feel as though they are already closer to the animal from knowing its history, potential traits, and what to expect.
3. **Buttons:** There were several locations these buttons could have been placed. I chose to place them below the animal/animal information because when adopting an animal, the animal and potential adoptee should both be granted the best fit. You do not want someone to skip through all of the information and simply press "Apply". At Happy Paws, we want what is best for the animal, and we want everyone who comes into the shelter to feel as though they can develop an immediate connection with a potential future pet.
4. **Additional images:** Finally at the bottom of the page, a few additional images of the animal can be seen. This is so that no matter where you are on the page, you can always see the animal you are currently looking at.

---

## 2. Back-end Communication
*Details on how the server-side logic handles dynamic content generation.*

* **Technology Stack:** PHP 8.x and JSON-based data storage.
* **Implementation:** The volunteer roles and pet profiles are not hard-coded. Instead, a PHP `include` fetches data from the `data/` directory.
* **Code Logic:** > Using a `foreach` loop, the site iterates through the data array to populate the `.pet-card` components. This allows for horizontal scaling; as the shelter grows, new roles populate automatically without manual HTML edits.

---

## 3. Style Guide Summary
*A reference for the visual brand identity applied across the A2 deployment.*

| Element | Value / Description |
| :--- | :--- |
| **Primary Color** | `#2c3e50` (Deep Navy - Trust & Professionalism) |
| **Secondary Color** | `#5dade2` (Sky Blue - Friendly & Approachable) |
| **Accent Color** | `#e67e22` (Orange - Interaction/Hover States) |
| **Typography** | Sans-serif (Segoe UI, Arial) for accessibility. |
| **UI Components** | Cards use an 8px border-radius with subtle box-shadows. |

---

## 4. Reflection
*A 300-word analysis of the design-to-prototype journey.*

---

## 5. Appendix: GitHub Activity Log
*Chronological record of the development process.*

```text
[Paste my 'git log --oneline' output here]