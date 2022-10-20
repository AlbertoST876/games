window.onload = function() {
    var menuBtn = document.querySelector("header nav span"),
        menu = document.querySelector("header nav ul");

    menuBtn.onclick = function() {
        if (menu.classList.contains("show")) {
            menu.classList.remove("show");
        } else {
            menu.classList.add("show");
        }
    };
};