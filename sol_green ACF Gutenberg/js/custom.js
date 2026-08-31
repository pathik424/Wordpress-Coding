
////////////////// Faq Section /////////////////

document.addEventListener("DOMContentLoaded", function () {
    const faqItems = document.querySelectorAll(".faq-item");
    faqItems.forEach(item => {
        const question = item.querySelector(".faq-question");
        if (!question) return;
        question.addEventListener("click", function () {
            item.classList.toggle("active");
        });
    });
});


/////////////////// Header //////////////////////

document.addEventListener("DOMContentLoaded", () => {
    const mobileIcon = document.querySelector(".mobileIcon");
 
    if (mobileIcon) {
        mobileIcon.addEventListener("click", () => {
            document.body.classList.toggle("menu-open");
        });
    }
});

////////////////// Pricing ////////////////////


document.addEventListener('DOMContentLoaded', function () {
  var tabs = document.querySelectorAll('.pricing-tab');
  var panels = document.querySelectorAll('.pricing-panel');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var target = tab.getAttribute('data-tab');
      // Update active tab styling
      tabs.forEach(function (t) {
        t.classList.remove('is-active');
        t.setAttribute('aria-selected', 'false');
      });
      tab.classList.add('is-active');
      tab.setAttribute('aria-selected', 'true');
      // Show the matching panel, hide the rest
      panels.forEach(function (panel) {
        if (panel.getAttribute('data-panel') === target) {
          panel.classList.add('is-active');
        } else {
          panel.classList.remove('is-active');
        }
      });
    });
  });
});



////////////////////////// Brand Section /////////////////////////

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".brand-swiper").forEach(function (container) {
        const wrapper = container.querySelector(".brand-wrapper");
        const slides = Array.from(wrapper.children);
        // Duplicate slides
        slides.forEach(slide => {
            wrapper.appendChild(slide.cloneNode(true));
        });

        const swiper = new Swiper(container, {
            slidesPerView: "auto",
            spaceBetween: 56,
            loop: false,
            allowTouchMove: false,
        });

        let isPaused = false;
        const speed = 0.7; // Increase for faster movement

        requestAnimationFrame(() => {
            const halfWidth = wrapper.scrollWidth / 2;
            function animate() {
                if (!isPaused) {
                    let translate = swiper.getTranslate() - speed;
                    if (Math.abs(translate) >= halfWidth) {
                        translate = 0;
                    }
                    swiper.setTranslate(translate);
                }
                requestAnimationFrame(animate);
            }
            animate();
        });

        // Pause immediately on hover
        container.addEventListener("mouseenter", () => {
            isPaused = true;
        });

        // Resume from same position
        container.addEventListener("mouseleave", () => {
            isPaused = false;
        });
    });
});


///////////////////////////// Testimonial Section /////////////////////////////

new Swiper('.testi-swiper', {
    slidesPerView: 3,
    spaceBetween: 24,
    centeredSlides: false,
    loop: true,
    grabCursor: true,
    speed: 5000,

    autoplay: {
        delay: 0,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    breakpoints: {
        0: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1025: {
            slidesPerView: 2.5,
            spaceBetween: 24,
        },
        1200:{
            slidesPerView: 3,
            spaceBetween: 24,
        }
    }
});