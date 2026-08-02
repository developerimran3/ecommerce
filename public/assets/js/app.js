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
