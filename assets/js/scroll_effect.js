// JavaScript for changing header background on scroll
window.addEventListener('scroll', function () {
    const header = document.querySelector('.header');
    const sahla = document.getElementById('SahlaIMG');
    const scrollPosition = window.scrollY;

    // Adjust this value based on when you want the background to change
    if (scrollPosition > 1) {
        header.classList.add('scrolled');
        sahla.setAttribute('src', './assets/Images/NLblack.png');
    } else {
        header.classList.remove('scrolled');
        sahla.setAttribute('src', './assets/Images/NL.png');
    }
});