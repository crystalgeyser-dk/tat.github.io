document.addEventListener("DOMContentLoaded", function() {
    // ナビゲーションのアクティブなリンクに active クラスを追加し、現在のページをハイライトする
    const currentLocation = window.location.href;
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        if (link.href === currentLocation) {
            link.classList.add("active");
        }
    });

    // ページ内リンクをスムーズにスクロールさせる
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // ここに他のページの動的な要素を操作するJavaScriptを追加する
});
