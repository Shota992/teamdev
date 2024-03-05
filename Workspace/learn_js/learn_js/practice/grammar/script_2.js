'use strict';

{
  //querySelectorを使って箇条書きの最初の要素を取得
  const first = document.querySelector('.item_1');
  console.log(first);

  //querySelectorを使ってidを用いて二つ目の要素を取得しよう
  const second = document.querySelector('#second_item');
  console.log(second);

  //ついでに中身だけを取ってこよう
  console.log(first.innerHTML);
  console.log(second.innerHTML);

  //querySelectorAllを使ってリストの全ての要素を取得しよう
  const list = document.querySelectorAll('.item')
  for(let i=0; i<list.length; i++){
    console.log(list[i]);
  }

  //getElementByIdを使って5つ目の要素を取得しよう
  const fifth = document.getElementById('fifth_item');
  console.log(fifth);
}

{
  // const list = document.querySelectorAll('.item');
  // //①for文を用いてリストの全ての要素をconsoleに映そう
  // for (let i = 0; i < list.length; i++) {
  //   console.log(list[i]);
  // }

  //その前に配列に置き換えよう（やらなくても良き）

  //①で取ってきたリストの内容をfor文で全て表示

  //foreachを使って全ての要素を「<名前>は明大生です。」としよう
  
}

{
  //if文
  const university = '慶應';

  //universityの値が慶應だったら福澤諭吉、明治だったら大六野耕作、それ以外はその他と表示させる


  //if省略
  //universityの値が慶應だったらtrue、間違っていたらfalseと表示する
}

{
  //イベント
  //ボタンをクリックしたら何か表示させましょう（思い浮かばなかったらclickedで）
  const btn = document.querySelector('.btn');
}