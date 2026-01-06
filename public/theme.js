document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('theme-toggle');
    const root = document.documentElement; // <html>

    // nolasām saglabāto tēmu
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
        root.classList.add('dark');
    }

    toggleBtn.addEventListener('click', () => {
        root.classList.toggle('dark');

        if (root.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});
