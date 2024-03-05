'use strict';

{
  //querySelectorを使って箇条書きの最初の要素を取得
  const tatsu = document.querySelector('.item_1');
  console.log(tatsu);

  //querySelectorを使ってidを用いて二つ目の要素を取得しよう

  //ついでに中身だけを取ってこよう
  console.log(tatsu.innerHTML);

  //querySelectorAllを使ってリストの全ての要素を取得しよう
  const names = document.querySelectorAll('.item');
  console.log(names);

  //getElementByIdを使って5つ目の要素を取得しよう
  const ryou = document.getElementById('fifth_item');
  console.log(ryou);
}

{
  //for文を用いてリストの全ての要素をconsoleに映そう
  const nameset = document.querySelectorAll('.item');
  //その前に配列に置き換えよう
  const nameArray = Array.from(nameset);

  console.log(nameset);
  console.log(nameArray);
  
  for (let i = 0; i < 7; i++){
    console.log(nameset[i]);
  }
  
  //foreachを使って全ての要素を「<名前>は明大生です。」としよう
  nameset.forEach(name => {
    // console.log(name);
    console.log(`${name.innerHTML}は明大生です。`);
    console.log(name.innerHTML + 'は明大生です。');
  })
}

{
  //if文
  const university = '慶應';

  if (university == '慶應') {
    console.log('福澤諭吉');
  } else if (university == '明治') {
    console.log('大六野耕作');
  } else {
    console.log('その他'); 
  }

  //if省略
  university == '慶應' ? console.log('true') : console.log('false');
}

{
  //イベント
  const btn = document.querySelector('.btn');

  console.log(btn);

  btn.addEventListener('click', () => {
    console.log('clicked');
  })
}