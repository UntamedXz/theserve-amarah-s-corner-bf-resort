let searchForm = document.querySelector('.search-form');
let overlay = document.querySelector('#backgroundOverlay');
let mobileMenu = document.querySelector('.dropdown-nav');
let alertbox = document.querySelector('.alert');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    overlay.classList.toggle('active');
}

document.querySelector('#backgroundOverlay').onclick = () => {
    searchForm.classList.remove('active');
    overlay.classList.remove('active');
}

document.querySelector('#navbar').onclick = () => {
    mobileMenu.classList.toggle('active');
}

document.querySelector('#close-menu').onclick = () => {
    mobileMenu.classList.remove('active');
}

document.querySelector('.dropdown-nav').onclick = () => {
    mobileMenu.classList.remove('active');
}



var updates_col = document.querySelectorAll('.col');
var load_more = document.querySelector('.load-more');

var current_updates_col = 2;
load_more.addEventListener('click', function() {
    for (var i = current_updates_col; i < current_updates_col + 2; i++) {
        if (updates_col[i]) {
            updates_col[i].style.display = 'block';
        }
    }
    current_updates_col += 2;
    if (current_updates_col >= updates_col.length) {
        event.target.style.display = 'none';
    }
});

var feedbacks_col = document.querySelectorAll(".feedbacks__card");
var load_more_feedbacks = document.querySelector(".load-more-feedbacks");

var current_feedbacks_col = 2;
load_more_feedbacks.addEventListener("click", function () {
  for (var i = current_feedbacks_col; i < current_feedbacks_col + 2; i++) {
    if (feedbacks_col[i]) {
      feedbacks_col[i].style.display = "block";
    }
  }
  current_feedbacks_col += 2;
  if (current_feedbacks_col >= feedbacks_col.length) {
    event.target.style.display = "none";
  }
});

window.onscroll = () => {

    navbar.classList.remove('active');
    searchForm.classList.remove('active');

    if (window.scrollY > 80) {
        document.querySelector('.custom-nav').classList.add('active');
    } else {
        document.querySelector('.custom-nav').classList.remove('active');
    }
}

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 'auto',
    spaceBetween: 15,
    centeredSlides: true,
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});