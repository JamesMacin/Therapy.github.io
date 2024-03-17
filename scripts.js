document.addEventListener("DOMContentLoaded", function () {
    var hamburger = document.querySelector('.hamburger-menu');
    var menuList = document.querySelector('.menu-list');

    hamburger.addEventListener('click', function () {
        menuList.classList.toggle('show');
    });
});
