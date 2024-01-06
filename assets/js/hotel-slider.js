const slides = document.querySelectorAll(".slide")
const imgSize = slides.length
var counter = 0;
//console.log(slides)

slides.forEach(
    (slide, index) => {
        slide.style.left = `${index * 100}%`
    }
)

const imgBefore = () => {
    counter = (counter - 1 + imgSize) % imgSize;
    slideImage()
}

const imgAfter = () => {
    counter = (counter+1) % imgSize
    slideImage()
}

const slideImage = () => {
    slides.forEach( 
        (slide) => {
            slide.style.transform = `translateX(-${counter * 100}%)`
        }
    )
}

const setCounterAndSlide = (index) => {
    counter = index;
    slideImage();
};