function toggleNav() {
    var nav = document.getElementById("mySidenav");
    nav.style.width = nav.style.width === "250px" ? "0" : "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}