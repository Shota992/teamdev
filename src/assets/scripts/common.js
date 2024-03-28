'use strict';

{
  const Header = document.getElementById('js-header');
  const HeaderButton = document.getElementById('js-headerButton');
  if (HeaderButton) {
    HeaderButton.addEventListener('click', () => {
      Header.classList.toggle('is-open')
    })
  }
}







// ユーザー画面1





// 10-1 総合特化選択画面
$(function () {
  $(".slider").slick({
    autoplay: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1
  });
});

