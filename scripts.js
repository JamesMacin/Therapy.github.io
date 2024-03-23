document.addEventListener("DOMContentLoaded", function () {
    // Select the menu list element
    var menuList = document.querySelector('.menu-list');

    // Prevent menu from closing when clicking on links inside the menu
    menuList.addEventListener('click', function (event) {
        event.stopPropagation();
    });
});

