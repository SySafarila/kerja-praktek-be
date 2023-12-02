const navbarToggle = document.getElementById("navbar-menu");
const navbarMenus = document.getElementById("navbar-menus");

navbarToggle.addEventListener("click", (e) => {
    e.preventDefault();
    navbarMenus.classList.toggle("hidden");
});
