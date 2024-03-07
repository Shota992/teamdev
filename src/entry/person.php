<!-- 個人情報入力ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>個人情報入力</title>
</head>
<body>
    <?php 
    // include __DIR__ . '../includes/header2.php'; 
    ?>
    <main>
        <div class="container">
            <div class="person-nav">
                <h1>Step4 個人情報の入力</h1>
            </div>
            <form class="person-form" method="POST">
                <div>
                    <div>
                        <label for="name" class="form-label">お名前</label>
                        <input type="text" name="name" id="name" class="form-control" />
                    </div>
                    <div>
                        <label for="readname" class="form-label">フリガナ</label>
                        <input type="text" name="readname" id="readname" class="form-control" />
                    </div>
                    <div>
                        <label for="" class="form-label">性別</label>
                        <input type="checkbox" name="male" id="male"/>
                        <label for="male">男性</label>
                        <input type="checkbox" name="female" id="female"/>
                        <label for="female">女性</label>
                        <input type="checkbox" name="none" id="none"/>
                        <label for="none">回答しない</label>
                    </div>
                    <div>
                        <label for="school" class="form-label">学校名</label>
                        <input type="text" name="school" id="school" class="form-control" />
                    </div>
                    <div>
                        <label for="phone" class="form-label">携帯電話番号</label>
                        <input type="text" name="phone" id="phone" class="form-control" />
                    </div>
                    <div>
                        <label for="e-mail" class="form-label">メールアドレス</label>
                        <input type="text" name="e-mail" id="e-mail" class="form-control" />
                    </div>
                    <div>
                        <label for="graduation-year" class="form-label">卒業年度</label>
                        <input type="checkbox" name="2025" id="2025" class="form-control" />
                        <label for="male">2025年卒</label>
                        <input type="checkbox" name="2026" id="2026" class="form-control" />
                        <label for="male">2026年卒</label>
                        <input type="checkbox" name="2027" id="2027" class="form-control" />
                        <label for="male">2027年卒</label>
                        <input type="checkbox" name="else" id="else" class="form-control" />
                        <label for="male">その他</label>
                    </div>
                    <div>
                        <label for="classification" class="form-label">文理区分</label>
                        <input type="checkbox" name="literature" id="literature" class="form-control" />
                        <label for="literature">文学系</label>
                        <input type="checkbox" name="education" id="education" class="form-control" />
                        <label for="education">教育学系</label>
                        <input type="checkbox" name="psychology" id="psychology" class="form-control" />
                        <label for="psychology">心理学系</label>
                        <input type="checkbox" name="linguistics" id="linguistics" class="form-control" />
                        <label for="linguistics">言語学系</label>
                        <input type="checkbox" name="politics" id="politics" class="form-control" />
                        <label for="politics">政治学系</label>
                        <input type="checkbox" name="economics" id="economics" class="form-control" />
                        <label for="economics">経済学系</label>
                        <input type="checkbox" name="law" id="law" class="form-control" />
                        <label for="law">法律学系</label>
                        <input type="checkbox" name="management" id="management" class="form-control" />
                        <label for="management">経営学系</label>
                        <input type="checkbox" name="science" id="science" class="form-control" />
                        <label for="science">理学系</label>
                        <input type="checkbox" name="engineering" id="engineering" class="form-control" />
                        <label for="engineering">工学系</label>
                        <input type="checkbox" name="pharmacy" id="pharmacy" class="form-control" />
                        <label for="pharmacy">薬学系</label>
                        <input type="checkbox" name="medicine" id="medicine" class="form-control" />
                        <label for="medicine">医学系</label>
                        <input type="checkbox" name="others" id="others" class="form-control" />
                        <label for="others">その他</label>
                    </div>
                    <div>
                        <label for="classification" class="form-label">志望業界</label>
                        <input type="checkbox" name="maker" id="maker" class="form-control" />
                        <label for="maker">メーカー</label>
                        <input type="checkbox" name="trading" id="trading" class="form-control" />
                        <label for="trading">商社</label>
                        <input type="checkbox" name="public-corporation" id="public-corporation" class="form-control" />
                        <label for="public-corporation">官公庁・公社</label>
                        <input type="checkbox" name="retail" id="retail" class="form-control" />
                        <label for="retail">小売</label>
                        <input type="checkbox" name="finance" id="finance" class="form-control" />
                        <label for="finance">金融</label>
                        <input type="checkbox" name="service" id="service" class="form-control" />
                        <label for="service">サービス</label>
                        <input type="checkbox" name="mass-media" id="mass-media" class="form-control" />
                        <label for="mass-media">マスコミ</label>
                        <input type="checkbox" name="IT" id="IT" class="form-control" />
                        <label for="IT">IT</label>
                        <input type="checkbox" name="no-decide" id="no-decide" class="form-control" />
                        <label for="no-decide">未定</label>
                    </div>
                </div>
                <button type="submit">送信する</button>
            </form>
        </div>
    </main>
    <?php 
    // include __DIR__ . '../includes/footer1.php'; 
    ?>
</body>
</html>