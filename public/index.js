
document.addEventListener('DOMContentLoaded', () => {
    const navItems = document.querySelectorAll('#nav-categories li');
    const posts = document.querySelectorAll('.post');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            const category = item.getAttribute('data-category');

            // 全てのナビゲーション項目を非アクティブにする
            navItems.forEach(nav => {
                nav.classList.add('inactive');
                nav.style.color = ''; // 元の色に戻す
            });
            
            // クリックした項目をアクティブにする
            item.classList.remove('inactive');
            item.style.color = 'black'; // アクティブな色に変更

            posts.forEach(post => {
                if (post.getAttribute('data-category') === category || category === 'おすすめ') {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });

    // 初期表示: おすすめを表示
    const initialCategory = document.querySelector('[data-category="おすすめ"]');
    if (initialCategory) {
        initialCategory.click();
    }
});


$(function () {
    $('.js-btn').on('click', function () { // js-btnクラスをクリックすると、
      $('.menu , .btn , .btn-line').toggleClass('open'); // メニューとバーガーの線にopenクラスをつけ外しする
    })
});
