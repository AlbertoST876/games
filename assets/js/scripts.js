window.onload = function() {
    let menuBtn = document.querySelector("header nav span");
    let menu = document.querySelector("header nav ul");
    
    menuBtn.onclick = function() {
        menu.classList.toggle("show");
    };
    
    if (typeof DataTable == "function") {
        new DataTable(".dataTable");
    }

    if (typeof NiceSelect != "undefined") {
        NiceSelect.bind(document.querySelector(".select2"), {searchable: true});
    }
};