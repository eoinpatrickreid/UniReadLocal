function toggleNav() {
    var sidenav = document.getElementById('mySidenav');
    if (sidenav.style.width === '250px') {
        sidenav.style.width = '0';
    } else {
        sidenav.style.width = '250px';
    }
}

function closeNav() {
    document.getElementById('mySidenav').style.width = '0';
}