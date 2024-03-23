<!-- 個人情報入力ページ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>個人情報入力</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/entry.css">
</head>

<body>
    <?php
    include_once  '../includes/header2.php';
    ?>
    <main class="main-body">
        <div class="container">
            <div class="person-nav">
                <h1 class="top-heading">Step4 個人情報の入力</h1>
                <p class="top-explanation">入力した情報は、CRAFT・申し込みをした企業にのみ公開されます。</p>
            </div>
            <form class="person-form" method="POST">
                <div>
                    <div class="form-tag">
                        <label for="name" class="form-label">お名前</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="readname" class="form-label">フリガナ</label>
                        <input type="text" name="readname" id="readname" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="" class="form-label">性別</label>
                        <input type="checkbox" name="male" id="male" />
                        <label for="male">男性</label>
                        <input type="checkbox" name="female" id="female" />
                        <label for="female">女性</label>
                        <input type="checkbox" name="none" id="none" />
                        <label for="none">回答しない</label>
                    </div>
                    <div class="form-tag">
                        <label for="school" class="form-label">学校名</label>
                        <input type="text" name="school" id="school" class="form-control" />
                    </div>
                    <div class="form-tag">
                        <label for="phone" class="form-label">携帯電話番号</label>
                        <input type="text" name="phone" id="phone" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="e-mail" class="form-label">メールアドレス</label>
                        <input type="text" name="e-mail" id="e-mail" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="graduation-year" class="form-label">卒業年度</label>
                        <input type="checkbox" name="2025" id="2025" />
                        <label for="male">2025年卒</label>
                        <input type="checkbox" name="2026" id="2026" />
                        <label for="male">2026年卒</label>
                        <input type="checkbox" name="2027" id="2027" />
                        <label for="male">2027年卒</label>
                        <input type="checkbox" name="else" id="else" />
                        <label for="male">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label">文理区分</label>
                        <input type="checkbox" name="literature" id="literature" />
                        <label for="literature">文学系</label>
                        <input type="checkbox" name="education" id="education" />
                        <label for="education">教育学系</label>
                        <input type="checkbox" name="psychology" id="psychology" />
                        <label for="psychology">心理学系</label>
                        <input type="checkbox" name="linguistics" id="linguistics" />
                        <label for="linguistics">言語学系</label>
                        <input type="checkbox" name="politics" id="politics" />
                        <label for="politics">政治学系</label>
                        <input type="checkbox" name="economics" id="economics" />
                        <label for="economics">経済学系</label>
                        <input type="checkbox" name="law" id="law" class="form-control" />
                        <label for="law">法律学系</label>
                        <input type="checkbox" name="management" id="management" />
                        <label for="management">経営学系</label>
                        <input type="checkbox" name="science" id="science" />
                        <label for="science">理学系</label>
                        <input type="checkbox" name="engineering" id="engineering" />
                        <label for="engineering">工学系</label>
                        <input type="checkbox" name="pharmacy" id="pharmacy" />
                        <label for="pharmacy">薬学系</label>
                        <input type="checkbox" name="medicine" id="medicine" />
                        <label for="medicine">医学系</label>
                        <input type="checkbox" name="others" id="others" />
                        <label for="others">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label">志望業界</label>
                        <input type="checkbox" name="maker" id="maker" />
                        <label for="maker">メーカー</label>
                        <input type="checkbox" name="trading" id="trading" />
                        <label for="trading">商社</label>
                        <input type="checkbox" name="public-corporation" id="public-corporation" />
                        <label for="public-corporation">官公庁・公社</label>
                        <input type="checkbox" name="retail" id="retail" />
                        <label for="retail">小売</label>
                        <input type="checkbox" name="finance" id="finance" />
                        <label for="finance">金融</label>
                        <input type="checkbox" name="service" id="service" />
                        <label for="service">サービス</label>
                        <input type="checkbox" name="mass-media" id="mass-media" />
                        <label for="mass-media">マスコミ</label>
                        <input type="checkbox" name="IT" id="IT" />
                        <label for="IT">IT</label>
                        <input type="checkbox" name="no-decide" id="no-decide" />
                        <label for="no-decide">未定</label>
                    </div>
                </div>
                <button type="submit" class="btn submit">送信する</button>
            </form>
        </div>
    </main>
    <?php
    include_once  '../includes/footer1.php'; 
    ?>
</body>

</html>