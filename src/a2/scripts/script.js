// Wait for the browser to finish loading the HTML
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Grab all the slides and the buttons
    const slides = document.querySelectorAll('.slide-item');
    const nextBtn = document.querySelector('.next');
    const prevBtn = document.querySelector('.prev');
    
    let currentSlide = 0; // The first slide (the cat) starts at index 0

    // 2. The function that handles switching the 'active' class
    function showSlide(index) {
        // Remove the 'active' class from the slide currently showing
        slides[currentSlide].classList.remove('active');
        
        // This math trick (Modulo %) makes the slides loop forever
        // If we go past the last slide, it sends us back to 0
        currentSlide = (index + slides.length) % slides.length;
        
        // Add the 'active' class to the new slide so it appears
        slides[currentSlide].classList.add('active');
    }

    // 3. Listen for clicks on the 'Next' button
    nextBtn.addEventListener('click', () => {
        showSlide(currentSlide + 1);
    });

    // 4. Listen for clicks on the 'Prev' button
    prevBtn.addEventListener('click', () => {
        showSlide(currentSlide - 1);
    });
});