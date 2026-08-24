(function () {
    function getSidebar() {
        return document.getElementById("sidebar");
    }

    // ==============================
    // CLOSE MENU
    // ==============================
    function closeMenu(item) {
        const toggle = item.querySelector(":scope > .menu-toggle");
        const submenu = item.querySelector(":scope > .submenu");
        const arrow = item.querySelector(":scope > .menu-toggle .arrow");

        item.classList.remove("open");

        if (toggle) {
            toggle.classList.remove("active");
            toggle.setAttribute("aria-expanded", "false");
        }

        if (submenu) {
            submenu.classList.remove("open");
        }

        if (arrow) {
            arrow.classList.remove("fa-chevron-down");
            arrow.classList.add("fa-chevron-right");
        }
    }

    // ==============================
    // OPEN MENU
    // ==============================
    function openMenu(item) {
        const toggle = item.querySelector(":scope > .menu-toggle");
        const submenu = item.querySelector(":scope > .submenu");
        const arrow = item.querySelector(":scope > .menu-toggle .arrow");

        if (!submenu) return;

        item.classList.add("open");
        submenu.classList.add("open");

        if (toggle) {
            toggle.classList.add("active");
            toggle.setAttribute("aria-expanded", "true");
        }

        if (arrow) {
            arrow.classList.remove("fa-chevron-right");
            arrow.classList.add("fa-chevron-down");
        }
    }

    // ==============================
    // CLOSE OTHER MENUS
    // ==============================
    function closeOthers(currentItem) {
        const sidebar = getSidebar();

        if (!sidebar) return;

        sidebar
            .querySelectorAll(":scope > div > .nav > .nav-item")
            .forEach(function (item) {
                if (item !== currentItem) {
                    closeMenu(item);
                }
            });
    }

    // ==============================
    // MENU CLICK
    // ==============================
    document.addEventListener("click", function (event) {
        const toggle = event.target.closest("#sidebar .menu-toggle");

        if (!toggle) return;

        event.preventDefault();
        event.stopPropagation();

        const item = toggle.closest(".nav-item");

        if (!item) return;

        const submenu = item.querySelector(":scope > .submenu");

        if (!submenu) return;

        const isOpen = submenu.classList.contains("open");

        if (isOpen) {
            closeMenu(item);
        } else {
            closeOthers(item);

            openMenu(item);
        }
    });

    // ==============================
    // ACTIVE MENU
    // ==============================
    function setActiveMenu() {
        const sidebar = getSidebar();

        if (!sidebar) return;

        const currentPath = window.location.pathname;

        let found = false;

        sidebar.querySelectorAll(".submenu a[href]").forEach(function (link) {
            const href = link.getAttribute("href");

            if (!href || href === "#" || href.startsWith("javascript:")) {
                return;
            }

            try {
                const url = new URL(href, window.location.origin);

                if (url.pathname === currentPath) {
                    link.classList.add("active");

                    const item = link.closest(".nav-item");

                    if (item) {
                        openMenu(item);
                    }

                    found = true;
                }
            } catch (error) {}
        });

        // Parent active route
        sidebar.querySelectorAll(".nav-link[href]").forEach(function (link) {
            const href = link.getAttribute("href");

            if (!href || href === "#" || href.startsWith("javascript:")) {
                return;
            }

            try {
                const url = new URL(href, window.location.origin);

                if (url.pathname === currentPath) {
                    link.classList.add("active");
                }
            } catch (error) {}
        });
    }

    // ==============================
    // INITIALIZE
    // ==============================
    function initialize() {
        setTimeout(function () {
            setActiveMenu();
        }, 50);
    }

    // First load
    initialize();

    // Livewire navigate
    document.addEventListener("livewire:navigated", function () {
        setTimeout(function () {
            setActiveMenu();
        }, 100);
    });
})();
