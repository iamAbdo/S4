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

document.addEventListener('DOMContentLoaded', function () {
    let currentImageIndex = 0;
    const images = document.querySelectorAll('.thumbnail');
    const totalImages = images.length;
  
    function showImage(index) {
      images.forEach(image => image.classList.remove('active'));
      images[index].classList.add('active');
      const largeImage = document.querySelector('.main-imgs img');
      largeImage.src = images[index].style.backgroundImage.slice(5, -2);
    }
  
    function nextImage() {
      currentImageIndex = (currentImageIndex + 1) % totalImages;
      showImage(currentImageIndex);
    }
  
    function prevImage() {
      currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
      showImage(currentImageIndex);
    }
  
    setInterval(nextImage, 4000);
  
    document.querySelector('.arrow.left').addEventListener('click', prevImage);
    document.querySelector('.arrow.right').addEventListener('click', nextImage);
  
    images.forEach((thumbnail, index) => {
      thumbnail.addEventListener('click', function () {
        showImage(index);
      });
    });
  
    showImage(currentImageIndex);
  });