document.addEventListener("DOMContentLoaded", function () {
    var hamburger = document.querySelector('.hamburger-menu');
    var menuList = document.querySelector('.menu-list');

    // Toggle menu visibility when hamburger menu is clicked
    hamburger.addEventListener('click', function () {
        menuList.classList.toggle('show');
    });

    // Reset menu to hamburger mode when navigating to a new page
    window.addEventListener('unload', function () {
        menuList.classList.remove('show');
    });
});