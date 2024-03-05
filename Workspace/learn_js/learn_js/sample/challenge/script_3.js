'use strict';

{
  const form = document.forms.profile;

  form.addEventListener('submit', event => {
    event.preventDefault();

    console.log(form.name.value);
    console.log(form.grade.value);
    form.language.forEach(l => {
      if (l.checked === true) {
        console.log(l.value);
      }
    })
  })
}

{
  const target = document.querySelector('.target');

  //クラス名を追加して文字の色を変えよう
  target.classList.add('red');

  //クラス名を削除して文字の色を元に戻そう
  target.classList.remove('red');
}

{
  //多重ループで名前生成してみよう〜
  const firstName = ['咲希', '亮', '颯人', '達弘'];
  const lastName = ['飯田', '猪瀬', '生川', '関根', '藤井', '江口'];

  // for (let i = 0; i < firstName.length; i++) {
  //   for (let j = 0; j < lastName.length; j++) {
  //     console.log(`${lastName[j]}${firstName[i]}`);
  //   }
  // }
}