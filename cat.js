document.addEventListener('DOMContentLoaded', function() {
    let g = document.querySelector("#wp-admin-bar-wp-logo a.ab-item");
    g.href="https://01cat.ru";
    g.innerHTML = '<img style="max-width:100%;height:auto;" src="/favicon.png" alt="Двоичный кот">';
});