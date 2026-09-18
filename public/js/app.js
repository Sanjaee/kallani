// Alpine.js will handle all interactive components
// This file contains utility functions and initialization

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Add fade-in animation to cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.6s ease-in-out';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.card, .stat-card').forEach(el => {
        observer.observe(el);
    });

    // Add active state to navigation links and sidebar items
    const rawPath = window.location.pathname;
    const cleanPath = (rawPath.replace('/kallani/public', '').replace(/\/$/, '') || '/');

    document.querySelectorAll('.nav-link, .sidebar-item').forEach(link => {
        const href = link.getAttribute('href');
        if (href) {
            const cleanHref = (href.replace('/kallani/public', '').replace(/\/$/, '') || '/');
            if (link.classList.contains('sidebar-item')) {
                if (cleanHref === cleanPath) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            } else {
                if (cleanHref === cleanPath) {
                    link.classList.add('active');
                } else if (cleanHref !== '/' && cleanPath.startsWith(cleanHref + '/')) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            }
        }
    });

    // Modal functionality
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
        }
    };

    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
        }
    };

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal.active').forEach(modal => {
                modal.classList.remove('active');
            });
        }
    });

    // Number animation for stat cards
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value.toLocaleString();
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    // Animate stat values when they come into view
    document.querySelectorAll('.stat-value').forEach(statCard => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const text = entry.target.textContent;
                    const number = parseInt(text.replace(/[^0-9]/g, ''));
                    if (!isNaN(number)) {
                        animateValue(entry.target, 0, number, 1000);
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        observer.observe(statCard);
    });
});

// Utility function to format currency
function formatCurrency(value) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value);
}

// Utility function to format percentage
function formatPercentage(value) {
    return value.toFixed(1) + '%';
}
