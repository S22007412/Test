let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showSlide(slideIndex) {
    slides.forEach((slide, index) => {
        slide.style.display = index === slideIndex ? 'block' : 'none';
    });
}

function changeSlide(n) {
    currentSlide += n;
    if (currentSlide < 0) currentSlide = totalSlides - 1;
    if (currentSlide >= totalSlides) currentSlide = 0;
    showSlide(currentSlide);
}

document.querySelectorAll('.nav').forEach(button => {
    button.addEventListener('click', function() {
        const direction = this.classList.contains('next') ? 1 : -1;
        changeSlide(direction);
    });
});

// Initially show the first slide
showSlide(currentSlide);
