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




// 10-1 総合特化選択画面
$(function () {
  $(".slider").slick({
    autoplay: false,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    infinite: true,
    responsive: [
        {
        breakpoint: 640,
            settings: {
                arrows: false,
                slidesToShow: 1,
                centerPadding: "10%",
                swipe: true,
                swipeToSlide: true,
            },
        },
    ],
  });
});


// 総合の絞り込み

    document.addEventListener('DOMContentLoaded', function() {
        const bigCheckbox = document.querySelector('input[name="general"][value="big"]');
        const smallCheckbox = document.querySelector('input[name="general"][value="small"]');
        const bigTags = document.querySelectorAll('.slider-tag.big');
        const smallTags = document.querySelectorAll('.slider-tag.small');

        function toggleSliderItems() {
          const showBig = bigCheckbox.checked;
          const showSmall = smallCheckbox.checked;

          bigTags.forEach(tag => {
              const parentSlide = tag.closest('.slide');
              if (parentSlide) { // 要素が存在する場合のみスタイルを設定する
                  if (showBig) {
                      parentSlide.style.display = 'block';
                  } else {
                      parentSlide.style.display = 'none';
                  }
              }
          });
      
          smallTags.forEach(tag => {
              const parentSlide = tag.closest('.slide');
              if (parentSlide) { // 要素が存在する場合のみスタイルを設定する
                  if (showSmall) {
                      parentSlide.style.display = 'block';
                  } else {
                      parentSlide.style.display = 'none';
                  }
              }
          });
      }

        bigCheckbox.addEventListener('change', toggleSliderItems);
        smallCheckbox.addEventListener('change', toggleSliderItems);

        // ページロード時に初期状態で表示を設定
        toggleSliderItems();
    });


// 特化の絞り込み

document.addEventListener('DOMContentLoaded', function() {
    const eigyouCheckbox = document.querySelector('input[name="special"][value="eigyou"]');
    const ITCheckbox = document.querySelector('input[name="special"][value="IT"]');
    const WebCheckbox = document.querySelector('input[name="special"][value="Web"]');
    const zeiCheckbox = document.querySelector('input[name="special"][value="zei"]');
    const kaikeiCheckbox = document.querySelector('input[name="special"][value="kaikei"]');
    const kaigoCheckbox = document.querySelector('input[name="special"][value="kaigo"]');
    const rihaCheckbox = document.querySelector('input[name="special"][value="riha"]');
    const hoikuCheckbox = document.querySelector('input[name="special"][value="hoiku"]');
    const kangoCheckbox = document.querySelector('input[name="special"][value="kango"]');
    const womanCheckbox = document.querySelector('input[name="special"][value="woman"]');
    const gaisiCheckbox = document.querySelector('input[name="special"][value="gaisi"]');
    
    const eigyouTags = document.querySelectorAll('.slider-tag.eigyou');
    const ITTags = document.querySelectorAll('.slider-tag.IT');
    const webTags = document.querySelectorAll('.slider-tag.Web');
    const zeiTags = document.querySelectorAll('.slider-tag.zei');
    const kaikeiTags = document.querySelectorAll('.slider-tag.kaikei');
    const kaigoTags = document.querySelectorAll('.slider-tag.kaigo');
    const rihaTags = document.querySelectorAll('.slider-tag.riha');
    const hoikuTags = document.querySelectorAll('.slider-tag.hoiku');
    const kangoTags = document.querySelectorAll('.slider-tag.kango');
    const womanTags = document.querySelectorAll('.slider-tag.woman');
    const gaisiTags = document.querySelectorAll('.slider-tag.gaisi');

    function toggleSliderItems() {
        const showEigyou = eigyouCheckbox.checked;
        const showIT = ITCheckbox.checked;
        const showWeb = WebCheckbox.checked;
        const showZei = zeiCheckbox.checked;
        const showKaikei = kaikeiCheckbox.checked;
        const showKaigo = kaigoCheckbox.checked;
        const showRiha = rihaCheckbox.checked;
        const showHoiku = hoikuCheckbox.checked;
        const showKango = kangoCheckbox.checked;
        const showWoman = womanCheckbox.checked;
        const showGaisi = gaisiCheckbox.checked;

        eigyouTags.forEach(tag => {
            tag.closest('.slide').style.display = showEigyou ? 'block' : 'none';
        });
        ITTags.forEach(tag => {
            tag.closest('.slide').style.display = showIT ? 'block' : 'none';
        });
        webTags.forEach(tag => {
            tag.closest('.slide').style.display = showWeb ? 'block' : 'none';
        });
        zeiTags.forEach(tag => {
            tag.closest('.slide').style.display = showZei ? 'block' : 'none';
        });
        kaikeiTags.forEach(tag => {
            tag.closest('.slide').style.display = showKaikei ? 'block' : 'none';
        });
        kaigoTags.forEach(tag => {
            tag.closest('.slide').style.display = showKaigo ? 'block' : 'none';
        });
        rihaTags.forEach(tag => {
            tag.closest('.slide').style.display = showRiha ? 'block' : 'none';
        });
        hoikuTags.forEach(tag => {
            tag.closest('.slide').style.display = showHoiku ? 'block' : 'none';
        });
        kangoTags.forEach(tag => {
            tag.closest('.slide').style.display = showKango ? 'block' : 'none';
        });
        womanTags.forEach(tag => {
            tag.closest('.slide').style.display = showWoman ? 'block' : 'none';
        });
        gaisiTags.forEach(tag => {
            tag.closest('.slide').style.display = showGaisi ? 'block' : 'none';
        });
    }

    eigyouCheckbox.addEventListener('change', toggleSliderItems);
    ITCheckbox.addEventListener('change', toggleSliderItems);
    WebCheckbox.addEventListener('change', toggleSliderItems);
    zeiCheckbox.addEventListener('change', toggleSliderItems);
    kaikeiCheckbox.addEventListener('change', toggleSliderItems);
    kaigoCheckbox.addEventListener('change', toggleSliderItems);
    rihaCheckbox.addEventListener('change', toggleSliderItems);
    hoikuCheckbox.addEventListener('change', toggleSliderItems);
    kangoCheckbox.addEventListener('change', toggleSliderItems);
    womanCheckbox.addEventListener('change', toggleSliderItems);
    gaisiCheckbox.addEventListener('change', toggleSliderItems);

    // ページロード時に初期状態で表示を設定
    toggleSliderItems();
});


// 総合特化の企業追加ボタン
    const submitButton = document.querySelector('.btn.submit')
    const inputDoms = Array.from(document.querySelectorAll('.required'))
    inputDoms.forEach(inputDom => {
        inputDom.addEventListener('input', event => {
        const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
        submitButton.disabled = !isFilled
        })
    })

    