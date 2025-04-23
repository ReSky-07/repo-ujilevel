/*!
 * Start Bootstrap - SB Admin v7.0.7
 */

// Scripts

window.addEventListener('DOMContentLoaded', event => {

    // Sidebar toggle button
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    const layout = document.getElementById('layoutSidenav');
    const overlay = document.getElementById('overlay');

    if (sidebarToggle && layout && overlay) {

        // Load toggle state if needed
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.add('sb-sidenav-toggled');
        // }

        // Toggle sidebar on button click
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();

            const isOpen = !layout.classList.contains('sidebar-hidden');

            if (isOpen) {
                layout.classList.add('sidebar-hidden');
                document.body.classList.remove('sidebar-visible');
            } else {
                layout.classList.remove('sidebar-hidden');
                document.body.classList.add('sidebar-visible');
            }

            // Optional: Persist state if needed
            // localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });

        // Hide sidebar when clicking overlay
        overlay.addEventListener('click', () => {
            layout.classList.add('sidebar-hidden');
            document.body.classList.remove('sidebar-visible');
        });
    }
});
