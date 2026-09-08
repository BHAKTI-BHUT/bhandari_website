// Get elements
const hamburgerBtn = document.getElementById('hamburgerBtn');
const closeMenuBtn = document.getElementById('closeMenuBtn');
const fullscreenMenu = document.getElementById('fullscreenMenu');

// Create overlay element
const menuOverlay = document.createElement('div');
menuOverlay.classList.add('menu-overlay');
document.body.appendChild(menuOverlay);

function openMenu() {
    fullscreenMenu.classList.add('active');
    menuOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMenuFunc() {
    fullscreenMenu.classList.remove('active');
    menuOverlay.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Hamburger button toggle
hamburgerBtn.addEventListener('click', function() {
    if (fullscreenMenu.classList.contains('active')) {
        closeMenuFunc();
    } else {
        openMenu();
    }
});

// Close button
closeMenuBtn.addEventListener('click', function() {
    closeMenuFunc();
});

// Close menu when clicking on overlay
menuOverlay.addEventListener('click', function() {
    closeMenuFunc();
});

// Close menu when clicking on a link
const menuLinks = document.querySelectorAll('.fullscreen-menu a');
menuLinks.forEach(link => {
    link.addEventListener('click', function() {
        closeMenuFunc();
    });
});

// Close menu on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && fullscreenMenu.classList.contains('active')) {
        closeMenuFunc();
    }
});