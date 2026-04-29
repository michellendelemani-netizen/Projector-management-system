function toggleMenu() {
        const menu = document.getElementById("mobileMenu");
        menu.classList.toggle("open");
    }

    /* reset when resizing to desktop */
    window.addEventListener("resize", function () {
        if (window.innerWidth > 700) {
            document.getElementById("mobileMenu").classList.remove("open");2
        }
    });

    /* set active tab based on current URL */
    const currentPage = window.location.pathname.split("/").pop();

    const allLinks = document.querySelectorAll(".tabs a, .mobile-menu a");

    allLinks.forEach(link => {
        const linkPage = link.getAttribute("href");

        if (linkPage === currentPage) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });