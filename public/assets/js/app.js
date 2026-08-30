$(document).ready(function () {
    var detailsSlider = $(".details_slider").owlCarousel({
        items: 1,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        autoHeight: true,
        smartSpeed: 400,
    });

    // Thumbnail click করলে বড় ইমেজ change হবে
    $(".indicator-item").on("click", function () {
        var index = $(this).data("id");
        detailsSlider.trigger("to.owl.carousel", [index, 300]);
    });
});

$(".carousel").carousel({
    interval: 3000,
});

// Scroll Top

window.onscroll = function () {
    let btn = document.getElementById("topBtn");

    if (document.documentElement.scrollTop > 300) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
};

document.getElementById("topBtn").onclick = function () {
    window.scrollTo({
        top: 0,

        behavior: "smooth",
    });
};

/* Sticky Navbar */

window.addEventListener("scroll", function () {
    let nav = document.querySelector(".main-nav");

    if (window.scrollY > 120) {
        nav.classList.add("sticky-nav");
    } else {
        nav.classList.remove("sticky-nav");
    }
});

/* Countdown */

let countDownDate = new Date();

countDownDate.setHours(23, 59, 59);

setInterval(function () {
    let now = new Date().getTime();

    let distance = countDownDate - now;

    let h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

    let m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    let s = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML =
        h + "h " + m + "m " + s + "s";
}, 1000);

/**
 * category slider
 */

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("categorySlider");

    if (!slider) return;

    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener("mousedown", function (e) {
        isDown = true;

        slider.classList.add("dragging");

        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener("mouseleave", function () {
        isDown = false;

        slider.classList.remove("dragging");
    });

    slider.addEventListener("mouseup", function () {
        isDown = false;

        slider.classList.remove("dragging");
    });

    slider.addEventListener("mousemove", function (e) {
        if (!isDown) return;

        e.preventDefault();

        const x = e.pageX - slider.offsetLeft;

        const walk = x - startX;

        slider.scrollLeft = scrollLeft - walk;
    });

    /*
    |--------------------------------------------------------------------------
    | Mouse Wheel
    |--------------------------------------------------------------------------
    */

    slider.addEventListener(
        "wheel",
        function (e) {
            if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                e.preventDefault();

                slider.scrollBy({
                    left: e.deltaY,
                    behavior: "smooth",
                });
            }
        },
        { passive: false },
    );
});

/**
 * category
 */
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("categorySlider");

    if (!slider) return;

    let autoPlay;
    let isDragging = false;
    let startX = 0;
    let startScrollLeft = 0;

    /* ==========================================
       GET ONE CATEGORY WIDTH
    ========================================== */

    function getSlideWidth() {
        const slide = slider.querySelector(".category-slide");

        if (!slide) return 0;

        const gap = parseInt(getComputedStyle(slider).gap) || 0;

        return slide.offsetWidth + gap;
    }

    /* ==========================================
       AUTO PLAY
       1 BAR = 1 TA SLIDE
    ========================================== */

    function nextSlide() {
        const slideWidth = getSlideWidth();

        if (!slideWidth) return;

        const maxScroll = slider.scrollWidth - slider.clientWidth;

        /*
         * যদি শেষের কাছাকাছি চলে যায়
         * তাহলে আবার প্রথমে যাবে
         */

        if (slider.scrollLeft >= maxScroll - 5) {
            slider.scrollTo({
                left: 0,
                behavior: "smooth",
            });
        } else {
            slider.scrollBy({
                left: slideWidth,
                behavior: "smooth",
            });
        }
    }

    function startAutoPlay() {
        clearInterval(autoPlay);

        autoPlay = setInterval(function () {
            if (!isDragging) {
                nextSlide();
            }
        }, 3000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlay);
    }

    /* ==========================================
       MOUSE HOVER = PAUSE
    ========================================== */

    slider.addEventListener("mouseenter", function () {
        stopAutoPlay();
    });

    slider.addEventListener("mouseleave", function () {
        if (!isDragging) {
            startAutoPlay();
        }
    });

    /* ==========================================
       MOUSE DRAG
    ========================================== */

    slider.addEventListener("mousedown", function (e) {
        isDragging = true;

        stopAutoPlay();

        slider.style.cursor = "grabbing";

        startX = e.pageX - slider.offsetLeft;

        startScrollLeft = slider.scrollLeft;
    });

    slider.addEventListener("mousemove", function (e) {
        if (!isDragging) return;

        e.preventDefault();

        const x = e.pageX - slider.offsetLeft;

        const walk = (x - startX) * 1.5;

        slider.scrollLeft = startScrollLeft - walk;
    });

    slider.addEventListener("mouseup", function () {
        isDragging = false;

        slider.style.cursor = "grab";

        startAutoPlay();
    });

    slider.addEventListener("mouseleave", function () {
        isDragging = false;

        slider.style.cursor = "grab";

        startAutoPlay();
    });

    /* ==========================================
       MOUSE WHEEL
    ========================================== */

    slider.addEventListener(
        "wheel",
        function (e) {
            if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                e.preventDefault();

                slider.scrollBy({
                    left: e.deltaY,
                    behavior: "smooth",
                });
            }
        },
        {
            passive: false,
        },
    );

    /* ==========================================
       TOUCH / MOBILE
    ========================================== */

    let touchStartX = 0;
    let touchStartScroll = 0;

    slider.addEventListener(
        "touchstart",
        function (e) {
            stopAutoPlay();

            touchStartX = e.touches[0].pageX;

            touchStartScroll = slider.scrollLeft;
        },
        {
            passive: true,
        },
    );

    slider.addEventListener(
        "touchmove",
        function (e) {
            const currentX = e.touches[0].pageX;

            const distance = touchStartX - currentX;

            slider.scrollLeft = touchStartScroll + distance;
        },
        {
            passive: true,
        },
    );

    slider.addEventListener(
        "touchend",
        function () {
            startAutoPlay();
        },
        {
            passive: true,
        },
    );

    /* ==========================================
       START AUTO PLAY
    ========================================== */

    startAutoPlay();
});
