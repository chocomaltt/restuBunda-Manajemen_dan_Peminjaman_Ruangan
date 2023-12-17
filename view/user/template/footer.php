<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>       
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
        <script src="dashboard.js"></script> 
        <script>
    document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.href;
    const menuItems = document.querySelectorAll('.list-group-item');

    for (let i = 0; i < menuItems.length; i++) {
        const menuItem = menuItems[i];
        const menuItemLink = menuItem.querySelector('a');
        const menuItemUrl = menuItemLink.getAttribute('href');

        if (currentUrl.includes(menuItemUrl)) {
            menuItem.classList.add('aktif');
            menuItem.closest('.dropdown').classList.add('show');
            break;
        }
    }
});
function activateMenu(event) {
    event.preventDefault();

    const menuItem = event.target.closest('.list-group-item');
    menuItem.classList.add('aktif');

    const dropdownMenu = menuItem.closest('.dropdown-menu');
    if (dropdownMenu) {
        dropdownMenu.parentElement.querySelector('.dropdown-toggle').classList.add('aktif');
        dropdownMenu.parentElement.classList.add('show');
    }

    const href = menuItem.querySelector('a').getAttribute('href');
    if (href) {
        window.location.href = href;
    }
}
        </script>
    </body>
</html>