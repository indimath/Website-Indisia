let slideIndex = 0; // Indeks slide aktif
const slides = document.querySelectorAll(".slides img");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    if (i === index) {
      slide.classList.add("active");
    }
  });
}

function moveSlide(step) {
  slideIndex += step;

  if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  }

  if (slideIndex >= slides.length) {
    slideIndex = 0;
  }

  showSlide(slideIndex);
}

// Inisialisasi tampilan awal
showSlide(slideIndex);

// Fungsi untuk autoplay
function autoPlaySlides() {
  slideIndex++;
  if (slideIndex >= slides.length) {
    slideIndex = 0; // Kembali ke slide pertama
  }
  showSlide(slideIndex);
}

// Atur interval otomatis 3 detik
let autoSlideInterval = setInterval(autoPlaySlides, 3000);

// Tambahkan event listener pada tombol navigasi untuk reset interval saat tombol ditekan
document.querySelector(".prev").addEventListener("click", () => {
  clearInterval(autoSlideInterval);
  moveSlide(-1);
  autoSlideInterval = setInterval(autoPlaySlides, 3000); // Restart interval
});

document.querySelector(".next").addEventListener("click", () => {
  clearInterval(autoSlideInterval);
  moveSlide(1);
  autoSlideInterval = setInterval(autoPlaySlides, 3000); // Restart interval
});
