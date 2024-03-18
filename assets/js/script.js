function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener('scroll', () => {
        const windowHeight = window.innerHeight;
        const scrollTop = window.scrollY;
        const sections = document.querySelectorAll('section');

        let currentSection = '';

        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= windowHeight / 2 && rect.bottom >= windowHeight / 2) {
                currentSection = section.getAttribute('id');
            }
        });

        if (scrollTop === 0) {
            currentSection = 'home';
        }

        const navLinks = document.querySelectorAll('.nav-btn');
        navLinks.forEach(link => {
            if (link.getAttribute('data-target') === currentSection) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    });
});
