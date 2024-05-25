document.addEventListener('DOMContentLoaded', function() {
    var tocContainer = document.querySelector('.utofc-toc');

    if (tocContainer) {
        // Smooth scroll to the clicked section
        tocContainer.addEventListener('click', function(event) {
            if (event.target.tagName === 'A') {
                event.preventDefault();

                var targetId = event.target.getAttribute('href').substring(1);
                var targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });

        // Toggle the table of contents visibility
        var toggleWrap = document.querySelector('.table-toggle-wrap');
        if (toggleWrap) {
            toggleWrap.addEventListener('click', function() {
                tocContainer.classList.toggle('active');
            });
        }
    }
});
