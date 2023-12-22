<style>
.profile-dropdown {
    position: relative;
    display: flex;
    /* Use flex to align items horizontally */
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 140%;
    /* Position the dropdown below the parent element */
    left: -250%;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* .dropdown-content a:hover {
        background-color: #f1f1f1;
    } */

.profile-dropdown.active .dropdown-content {
    display: block;
}
</style>

<main>
    <header style="flex-direction: row-reverse;">
        <div class="profile-dropdown" id="profile-dropdown">
            <a href="#" class="d-flex flex-row w-100" id="profile-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="39.403" height="40" viewBox="0 0 24 24"
                    style="fill: #fff;">
                    <path
                        d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                    </path>
                </svg>
            </a>
            <div class="dropdown-content" id="dropdown-content">
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
    <script>
    var profileDropdown = document.getElementById('profile-dropdown');

    document.getElementById('profile-icon').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to the window

        // Toggle the 'active' class on the profile dropdown
        profileDropdown.classList.toggle('active');
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (!event.target.matches('#profile-icon')) {
            // Close the dropdown if it is active
            profileDropdown.classList.remove('active');
        }
    });
    </script>