window.onload = function() {
    let menuBtn = document.querySelector("header nav span");
    let menu = document.querySelector("header nav ul");
    
    menuBtn.onclick = function() {
        menu.classList.toggle("show");
    };
    
    if (window.location.pathname == "/admin/users.php" || window.location.pathname == "/admin/games.php" || window.location.pathname == "/admin/reports.php") {
        new DataTable(".dataTable");
    }

    if (window.location.pathname == "/report.php") {
        NiceSelect.bind(document.querySelector(".select2"), {searchable: true});
    }
};