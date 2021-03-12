document.getElementById("toggle-navigator").addEventListener("click", function() {
    var nav = document.getElementById("navigator");
    if (nav.classList.contains("open")) {
        nav.classList.remove("open");
    } else {
        nav.classList.add("open");
    }
});
