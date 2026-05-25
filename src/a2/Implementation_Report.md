# Implementation Report: Happy Paws Animal Shelter
**Author:** David Matic (mati0046)  
**Date:** May 2026  
**Directory:** project-docs/src/A2/

---

## 1. Website Functionality & Flow

### 1.1 Home Page (`index.php`)
![Home Page Screenshot](images/homepage.png)

**Annotations:**
1. **Horizontal Menu:** The reason for this menu style is because it brings simplicity to the website and with the users attention being directly at the center where the logo is, it creates ease of use. 
2. **Search Bar:** Large, accessible search bar to solve the user's primary intent immediately right inbetween all the content.
3. **Slideshow:** This slideshow is meant to show some of the animals that the shelter have. They can be searched for directly above in the search bar, or via the "Available Pets" menu option.
4. **Vertically stacked footer:** This is a very clean and clear way to handle all of the relevant information respective to the shelter; their phone number, address, etc. It is a common approach, brings an additional layer to the website and takes up some space. 

### 1.2 About Us (`about.html`)
![About Us Screenshot](images/about.png)

**Annotations:**
1. **Photo placement:** When you want to know about a company, place, area or so on, it is good to have a photo that is clearly visible in the "About" section. It is placed near the text while keeping nice clean vertical borders for tidiness. 
2. **Text blocks:** Large text blocks that are clearly separated. These were kept simple because nothing fancy needs to be added to a page where someone wants to get a brief and concise block of information about who the shelter is.

### 1.3 Available Pets (`adoption.php`)
![Available Pets Screenshot](images/adoption.png)

**Annotations:**
1. **Filter option:** This might be obsolete considering the search bar located in both the home page and adoption page but having more search options via a filter is good because a shelter might have dozens and dozens if not more pets so any sort of filtering option adds efficiency and precision. 
2. **Available Pets layout:** The reason for this layout is because it is neat, spacious and extremely easy to navigate. Neatly stacked rows and columns with a maximum of 3 animals per row and only several traits are visible to keep it compact.

### 1.4 Donate (`donate.php`)
![Donate Screenshot](images/donate.png)

**Annotations:**
1. **Only valid payment amount allowed:** A straight forward donation form. When attempting to enter an invalid donation amount such as $0 or a negative value, an error pops up that must be corrected before proceeding with any donation.

### 1.5 Pet Details (`pet-details.php`)
![Pet Details Screenshot](images/pet-details.png)

**Annotations:**
1. **Vertical animal information:** You want the potential adoptee to immediately see the animal they are looking at. With this layout completely centered with the information immediately eye-catching in the slightly darkened grey box, all the information is processed quickly. 
2. **Additional Information:** Providing all the required and relevant information necessary about the animal. Providing as much information as possible is good because the adoptee might feel as though they are already closer to the animal from knowing its history, potential traits, and what to expect.
3. **Buttons:** There were several locations these buttons could have been placed. I chose to place them below the animal/animal information because when adopting an animal, the animal and potential adoptee should both be granted the best fit. You do not want someone to skip through all of the information and simply press "Apply". At Happy Paws, we want what is best for the animal, and we want everyone who comes into the shelter to feel as though they can develop an immediate connection with a potential future pet.
4. **Additional images:** Finally at the bottom of the page, a few additional images of the animal can be seen. This is so that no matter where you are on the page, you can always see the animal you are currently looking at.

### 1.6 Apply to Adopt (`application.php`)
![Apply to Adopt Screenshot](images/application.png)

**Annotations:**
1. **Adoption Information:** When proceeding with an application, the user is informed on which animal they are currently trying to apply to adopt. This is to ensure no mistakes are made, such as accidental clicks on the wrong animal or just to confirm the animal they are trying to adopt. The approach is to ensure that every step of the way, the potential adoptee has all the relevant information necessary.
2. **Adoptee details:** For animal shelter workers, having a great range of information about a potential adoptee makes a huge difference. For example if a potential adoptee wants to adopt a very outgoing, excitable dog such as a French Bulldog, having a living environment that is potentially limiting or an adoptee with the complete opposite personality of that particular breed of dog might not be the best match -- not necessarily bad, but that is why the enquiry option exists aswell.

### 1.7 Feedback (`feedback.php`)
![Feedback Screenshot](images/feedback.png)

**Annotations:**
1. **Simplicity:** Having a simple and familiar form (as all forms on the website are similar) is both inviting and provides ease of use, which is important.

### 1.8 Admin Portal (`admin.php`)
![Admin Portal Login Screenshot](images/admin.png)

**Annotations:**
1. **Security:** The Admin Portal comes with security to ensure that only staff members are able to access the portal with a shared username and password. In a real world scenario, this typically would not be ideal as anyone could accidentally give away the password, especially with former employees but in a closeknit animal shelter, having a global username and password to simply add/edit/remove pets from the available selection is sufficient. An error message is displayed when entering the wrong username/password.

### 1.81 Admin Portal (`admin.php`)
![Admin Portal Screenshot](images/admin2.png)

**Annotations:**
1. **Buttons:** There is an option to log out that way once a worker is signed in, the account is not stuck signed in so this also adds security. From there you can add a new pet listing with a button almost directly centered on the screen so it is extremely straight forward.
2. **Pet listings:** The Admin Portal features a list of every pet, trackable via ID and Name, with active status showing whether or not the pet is available. From there you can press Edit or Delete on any particular animal depending on the requirements.

### 1.9 Add Pet (`add_pet.php`)
![Add Pet Screenshot](images/add_pet.png)

**Annotations:**
1. **Adding a pet into the system:** Every piece of information and trait of an animal can be entered, with complete guidance via the examples that are in each text box.
2. **Adding photos:** There is an entire section dedicated to adding the main photo which appears on the Adoption page, and then the two additional smaller photos which are in the specific page of a particular animal.

### 1.10 Edit Pet (`edit_pet.php`)
![Edit Pet Screenshot](images/edit_pet.png)

**Annotations:**
1. **Edit Pet information:** When editing a pet, you do not want to make a mistake by altering traits or fields that do not need to be touched. Therefore I made the decision to have every field pre-filled with the existing values to make it more straight forward, and from there the admin can decide on which areas need altering. On top of that, the name of the current pet being edited is displayed at the top.

---

## 2. Back-end Communication
*Details on how the server-side logic handles dynamic content generation.*

* **Technology Stack:** PHP 8.x and JSON-based data storage.
* **Implementation:** The volunteer roles and pet profiles are not hard-coded. Instead, a PHP `include` fetches data from the `data/` directory.
* **Code Logic:** > Using a `foreach` loop, the site iterates through the data array to populate the `.pet-card` components. This allows for horizontal scaling; as the shelter grows, new roles populate automatically without manual HTML edits.
* **Form Processing & File Management:** Administrative actions (adding/editing pets) use POST requests to transmit multipart form data. The server-side PHP handles unique file renaming (using timestamps) and dynamically updates the JSON database without overwriting existing data.

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
The transition from the initial static design to a fully functional dynamic prototype was a highly educational process. Initially, the Happy Paws layout was designed using hardcoded HTML and CSS, which allowed for rapid UI and layout testing but lacked scalability. Moving to a PHP and JSON-based backend required a significant shift in thinking, as the presentation layer had to be decoupled from the data layer. This separation ultimately made the prototype much more robust, allowing new pets to be populated automatically without touching the core HTML structure.

The complexity of development spiked significantly when implementing the administrative operations. Specifically, building the "Add Pet" and "Edit Pet" functionalities required careful handling of server-side interactions. Managing multipart form data for image uploads, dynamically generating unique filenames using timestamps to prevent overwrites, and synchronizing these physical files with the JSON database proved to be the most technically demanding aspects of the project. It required strict attention to PHP array manipulation, null coalescing, and data validation to ensure existing information wasn't accidentally deleted during edits.

Finally, several accommodations were necessary to ensure a successful deployment to the live server environment. One major hurdle was file pathing; utilizing relative absolute paths via PHP's __DIR__ constant became essential to prevent broken data links when scripts were executed from different directories. Additionally, server directory permissions had to be accounted for so that the PHP script had the necessary write access to save uploaded photos into the images/ folder. Implementing strict session handling was also required to secure the admin portal from unauthorized access. Overcoming these server-side hurdles ultimately resulted in a secure, dynamic, and easily maintainable website.

---

## 5. Appendix: GitHub Activity Log

![Github Commits 1 Screenshot](images/github_commits1.png)

![Github Commits 2 Screenshot](images/github_commits2.png)