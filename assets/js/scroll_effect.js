// JavaScript for changing header background on scroll
window.addEventListener('scroll', function () {
    const header = document.querySelector('.Header');
    const scrollPosition = window.scrollY;

    // Adjust this value based on when you want the background to change
    if (scrollPosition > 1) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});