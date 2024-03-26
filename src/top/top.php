<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/top.css">
    <link rel="stylesheet" href="../assets/sp/sp-top.css">
</head>
<body>

    <main>
        <section class="mainvisual">
            <div class="mainvisual-inner">
                <div class="mainvisual-head">
                    <div class="mainvisual-head-div">
                            <h1 class="mainvisual-title">CRAFT</h1>
                            <p class="mainvisual-lead">エージェント企業比較サイト</p>
                        <a href="" class="mainvisual-button">
                            <p class="mainvisual-button-title">新規登録</p>
                            <p class="mainvisual-button-lead">して企業に申し込み</p>
                        </a>
                    </div>
                </div>
            </div> 
        </section>
        <div class="container">
            <section>
                <div class="card-container">
                    <figure class="card-figure">
                        <img src="../assets/img/top1.png" alt="エージェント企業とはの画像" class="card-img" >
                    </figure>
                    <div class="card-content">
                        <div class="card-content-head">
                            <h2 class="card-content-title">
                                エージェント企業とは
                            </h2>
                            <a href="" class="card-content-button">
                                詳細
                            </a>
                        </div>
                        <div class="card-content-text">
                            <p>
                                就活支援をしてくれるサービスのこと
                            <br>
                                就活生は無料で利用できます
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-container reverse">
                    <figure class="card-figure reverse">
                        <img src="../assets/img/top2.png" alt="エージェント企業の選び方の画像" class="card-img" >
                    </figure>
                    <div class="card-content reverse">
                        <div class="card-content-head">
                            <h2 class="card-content-title">
                                エージェント企業の選び方
                            </h2>
                            <a href="" class="card-content-button">
                                詳細
                            </a>
                        </div>
                        <div class="card-content-text">
                            <p>
                                ・求人数が多い
                            <br>
                                ・自宅から通いやすい
                            <br>
                                ・もしくはオンライン面談に対応
                            </p>
                        </div>
                    </div>

                </div>
                <div class="card-container">
                    <figure class="card-figure">
                        <img src="../assets/img/top3.png" alt="活用のポイントの画像" class="card-img">
                    </figure>
                    <div class="card-content">
                        <div class="card-content-head">
                            <h2 class="card-content-title">
                                活用のポイント
                            </h2>
                            <a href="" class="card-content-button">
                                詳細
                            </a>
                        </div>
                        <div class="card-content-text">
                            <p>
                                ・複数社を登録
                            <br>
                                ・総合型と特化型のエージェント
                            <br>
                                ・アドバイザーが合わない場合は変更してもらう
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div>
                    <div class="top_list_head">
                        <h2 class="top_list_title">エージェント企業一覧</h2>
                    </div>
                </div>
            </section>
            <div class="slider-container">
                <div class="slider">
                    <div class="slides" data-duration="10">
                        <div class="slide">
                            <img src="../assets/img/top_doda_ikon.png" alt="dodaのアイコン" width="175px" height="70px" class="slide-img">
                            <img src="../assets/img/top_rikunabi_ikon.png" alt="リクナビのアイコン" width="175px" height="70px"class="slide-img">
                            <img src="../assets/img/top_doda_ikon.png" alt="dodaのアイコン" width="175px" height="70px" class="slide-img" >
                            <img src="../assets/img/top_rikunabi_ikon.png" alt="リクナビのアイコン" width="175px" height="70px" class="slide-img">
                        </div>
                        <div class="slide">
                            <img src="../assets/img/top_doda_ikon.png" alt="dodaのアイコン" width="175px" height="70px" class="slide-img" >
                            <img src="../assets/img/top_rikunabi_ikon.png" alt="リクナビのアイコン" width="175px" height="70px" class="slide-img">
                            <img src="../assets/img/top_doda_ikon.png" alt="dodaのアイコン" width="175px" height="70px" class="slide-img">
                            <img src="../assets/img/top_rikunabi_ikon.png" alt="リクナビのアイコン" width="175px" height="70px" class="slide-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<script>
    window.addEventListener( 'DOMContentLoaded', ( event ) => {
 
 const slides = document.getElementsByClassName('slides');
 
 for ( let i = 0; i < slides.length; ++i ) {
   // 対象ラッパー要素
   const target = slides[ i ];
   // ループ1回分の時間
   const duration = parseInt( target.dataset.duration ) * 1000 || 10000;
   // スライダーの進行方向(右から左 or 左から右)
   const isAlternate = target.classList.contains( 'alternate' );
   // ロゴ数の取得
   const childNum = target.firstElementChild.children.length;
   // ロゴの幅の算出
   const logoWidth = ( (100 / childNum ) * 100 / 100 ).toFixed( 2 );
   // ロゴの幅をセット
   target.style.setProperty( '--logo-width', `${ logoWidth }%` );

   // 開始時間
   let startTime = 0;
   // 経過時間
   let elapsed = 0;
   // 進捗(0-1)
   let progress = 0;

   const loop　 = ( currentTime ) => {
     if ( !startTime ) {
       startTime = currentTime;
     }
     // 現在の経過時間
     elapsed = currentTime - startTime;
     // 現在の進捗
     progress = Math.min( 1, elapsed / duration );

     // 進捗が 100%(位置が 50%)になったらリセットして再ループ
     if ( progress >= 1 ) {
       startTime = 0;
       elapsed = 0;
       progress = 0;
     }

     // スライドの位置を更新
     if ( isAlternate ) {
       // 左から右の場合
       target.style.transform = `translate3d(${ -50 + progress * 50 }%, 0, 0)`;
     } else {
       // 右から左の場合
       target.style.transform = `translate3d(-${ progress * 50 }%, 0, 0)`;
     }

     // 次のフレームをリクエストする
     window.requestAnimationFrame( loop );
   }

   // ループを開始
   window.requestAnimationFrame( loop );
 };
} );
</script>
</html>