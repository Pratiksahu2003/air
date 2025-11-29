/**
 * Admin Dashboard JavaScript
 */

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize admin dashboard functionality
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Sidebar toggle for mobile (if needed in future)
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        });
    }

    // Active menu item highlighting
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('.sidebar-menu a');
    menuLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Logout confirmation (optional)
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to logout?')) {
                e.preventDefault();
            }
        });
    }

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Submenu toggle functionality
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    submenuToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parentLi = this.closest('li.has-submenu');
            const submenu = parentLi.querySelector('.submenu');
            
            if (submenu) {
                // Toggle the show class
                submenu.classList.toggle('show');
                // Toggle the active class on parent
                parentLi.classList.toggle('active');
            }
        });
    });

    // Keep submenu open if it contains an active link
    const activeSubmenuLinks = document.querySelectorAll('.submenu a.active');
    activeSubmenuLinks.forEach(function(link) {
        const submenu = link.closest('.submenu');
        const parentLi = link.closest('li.has-submenu');
        if (submenu && parentLi) {
            submenu.classList.add('show');
            parentLi.classList.add('active');
        }
    });

    console.log('Admin Dashboard initialized');
});

