window.onload = function() {
    let menuBtn = document.querySelector("header nav span");
    let menu = document.querySelector("header nav ul");
    
    menuBtn.onclick = function() {
        menu.classList.toggle("show");
    };
     
    if (typeof NiceSelect != "undefined") {
        NiceSelect.bind(document.querySelector(".select2"), { searchable: true });

        let niceSelect = document.querySelector(".nice-select");

        niceSelect.style.display = "inline-block";
        niceSelect.style.paddingLeft = "10px";
        niceSelect.style.float = "none";
    }

    if (typeof DataTable == "function") new DataTable(".dataTable");
};