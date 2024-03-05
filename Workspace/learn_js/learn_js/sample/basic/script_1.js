'use strict';

//まず、basic/index.htmlにscriptタグでこのjsをリンクさせよう！

{
  const university = '明治';

  //「私は明治大学に通っています」とconsoleに上の定数を用いて表示させましょう
}

{
  const universities = ['明治', '慶應'];
  console.log(`私は${universities[1]}生です`); //ここ問題に
}

{
  //const, var, letの違い
  const number = 1;
  var color = 'blue';
  let gender = 'male';

  number = 5;
  console.log(number);

  color = 'purple';
  console.log(color);

  gender = 'female';
  console.log(gender);
}

//スコープ
console.log(number);
console.log(color);
console.log(gender);

{
  //ホイスティング
  console.log(number);
  const number = 1;
  
  console.log(color);
  var color = 'blue';
  
  console.log(gender);
  let gender = 'male';
}