<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nav = document.querySelector('nav');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                nav.classList.add('shadow-md', 'py-2');
                nav.classList.remove('py-4');
            } else {
                nav.classList.remove('shadow-md', 'py-2');
                nav.classList.add('py-4');
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.glass-card, section h2, .lg\\:col-span-8, .lg\\:col-span-4').forEach(el => {
            el.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(el);
        });
    });
</script>
