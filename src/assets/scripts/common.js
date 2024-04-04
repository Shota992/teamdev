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


// ヘッダーのハンバーガーメニュー
const burger = document.querySelector(".burger")
const nav = document.querySelector(".header-nav1")
const navLinks = document.querySelectorAll(".header-nav1 ul")


burger.addEventListener("click", () =>{
  nav.classList.toggle("nav-active");

  navLinks.forEach((link,index) =>{
    console.log(index);
    link.style.animation = 'navLinksFade 0.5s ease forwards ';
  })
    



});

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

