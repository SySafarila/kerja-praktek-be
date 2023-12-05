const navbarToggle = document.getElementById("navbar-menu");
const navbarMenus = document.getElementById("navbar-menus");

navbarToggle.addEventListener("click", (e) => {
    e.preventDefault();
    navbarMenus.classList.toggle("hidden");
    if (!navbarMenus.classList.contains("hidden")) {
        navbarToggle.innerText = 'close';
    } else {
        navbarToggle.innerText = 'menu';
    }
});
