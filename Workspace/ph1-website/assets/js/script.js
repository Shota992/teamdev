//ヘッダー・ボタンの要素を取得
const header = document.getElementById('js-header');
const button = document.getElementById('js-headerButton');

//ボタンをクリックした時の処理
button.addEventListener('click',function(){
    header.classList.toggle("is-open");
});

console.log(header);

//メインビジュアルの要素を取得
const mainVisual = document.getElementById("js-mainVisual");

//スクロールした時の処理
window.addEventListener("scroll",function(){
    if(window.scrollY > mainVisual.clientHeight - header.clientHeight){
        header.classList.remove("is-transparent");
    }else{
        header.classList.add("is-transparent");
    }
});

const eventSlideOptions = {
    type: 'loop',
    gap: 40,
    width: 1096,
    padding: { left:28, right:28 },
    perPage: 3,
    pagination: false,
    breakpoints: {
        768:{
            perPage: 1,
            pagination: true,
        },
    },
}

new Splide('#js-eventSlide', eventSlideOptions).mount();


const dailySlideOptions = {
    type: 'loop',
    gap: 40,
    padding: { left:28, right:28 },
    destroy: true,
    breakpoints: {
        768:{
            destroy: false,
        },
    },    
}

new Splide('#js-dailySlide', dailySlideOptions).mount();