<?php
session_start();

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力されたデータを取得
    $name = $_POST['name'];
    $sub_name = $_POST['sub_name'];
    $tel_num = $_POST['phone'];
    $mail = $_POST['e-mail'];
    $school = isset($_POST['school']) ? $_POST['school'] : "";
    $graduation_year = isset($_POST['graduation_year']) ? $_POST['graduation_year'] : "その他";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "回答しない";
    $division = isset($_POST['division']) ? implode(", ", $_POST['division']) : "";
    $desire = isset($_POST['desire']) ? implode(", ", $_POST['desire']) : "";

    // 必須項目の入力チェック
    if (empty($name) || empty($sub_name) || empty($tel_num) || empty($mail)) {
        // 必須項目が未入力の場合はエラーメッセージを表示して終了
        echo "必須項目が入力されていません。";
        exit;
    }

    // データベースに接続
    require_once("../dbconnect.php");

    try {
        // データを挿入するSQL文を準備
        $sql = "INSERT INTO student (name, sub_name, sex, school, tel_num, mail, graduation, division, desire)
                VALUES (:name, :sub_name, :gender, :school, :tel_num, :mail, :graduation, :division, :desire)";

        // プリペアドステートメントを作成
        $stmt = $dbh->prepare($sql);

        // プレースホルダに値をバインド
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sub_name', $sub_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':school', $school);
        $stmt->bindParam(':tel_num', $tel_num);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':graduation', $graduation_year);
        $stmt->bindParam(':division', $division);
        $stmt->bindParam(':desire', $desire);

        // SQL文を実行
        $stmt->execute();

        // データベース接続を閉じる
        $dbh = null;

        // リダイレクト先のURLを設定
        $redirect_url = "../entry/finalcheck.php";

        // リダイレクト
        header("Location: $redirect_url");
        exit;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <label for="sub_name" class="form-label">フリガナ</label>
                        <input type="text" name="sub_name" id="sub_name" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="sex" class="form-label">性別</label>
                        <input type="checkbox" name="gender" id="male" />
                        <label for="male" class="person_checkbox">男性</label>
                        <input type="checkbox" name="gender" id="female" />
                        <label for="female" class="person_checkbox">女性</label>
                        <input type="checkbox" name="gender" id="none" />
                        <label for="none" class="person_checkbox">回答しない</label>
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
                        <input type="checkbox" name="graduation_year" id="graduation-2025" />
                        <label for="graduation-2025" class="person_checkbox">2025年卒</label>
                        <input type="checkbox" name="graduation_year" id="graduation-2026" />
                        <label for="graduation-2026" class="person_checkbox">2026年卒</label>
                        <input type="checkbox" name="graduation_year" id="graduation-2027" />
                        <label for="graduation-2027" class="person_checkbox">2027年卒</label>
                        <input type="checkbox" name="graduation_year" id="graduation-else" />
                        <label for="graduation-else" class="person_checkbox">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label">文理区分</label>
                    </div>
                    <div class="form-tagContent">
                        <input type="checkbox" name="division[]" value="literature" id="literature" />
                        <label for="literature" class="person_checkbox">文学系</label>
                        <input type="checkbox" name="division[]" value="education" id="education" />
                        <label for="education" class="person_checkbox">教育学系</label>
                        <input type="checkbox" name="division[]" value="psychology" id="psychology" />
                        <label for="psychology" class="person_checkbox">心理学系</label>
                        <input type="checkbox" name="division[]" value="linguistics" id="linguistics" />
                        <label for="linguistics" class="person_checkbox">言語学系</label>
                        <input type="checkbox" name="division[]" value="politics" id="politics" />
                        <label for="politics" class="person_checkbox">政治学系</label>
                        <input type="checkbox" name="division[]" value="economics" id="economics" />
                        <label for="economics" class="person_checkbox">経済学系</label>
                        <input type="checkbox" name="division[]" value="law" id="law" class="form-control" />
                        <label for="law" class="person_checkbox">法律学系</label>
                        <input type="checkbox" name="division[]" value="management" id="management" />
                        <label for="management" class="person_checkbox">経営学系</label>
                        <input type="checkbox" name="division[]" value="science" id="science" />
                        <label for="science" class="person_checkbox">理学系</label>
                        <input type="checkbox" name="division[]" value="engineering" id="engineering" />
                        <label for="engineering" class="person_checkbox">工学系</label>
                        <input type="checkbox" name="division[]" value="pharmacy" id="pharmacy" />
                        <label for="pharmacy" class="person_checkbox">薬学系</label>
                        <input type="checkbox" name="division[]" value="medicine" id="medicine" />
                        <label for="medicine" class="person_checkbox">医学系</label>
                        <input type="checkbox" name="division[]" value="others" id="others" />
                        <label for="others" class="person_checkbox">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label" class="person_checkbox">志望業界</label>
                    </div>
                    <div class="form-tagContent">
                        <input type="checkbox" name="desire[]" value="maker" id="maker" />
                        <label for="maker" class="person_checkbox">メーカー</label>
                        <input type="checkbox" name="desire[]" value="trading" id="trading" />
                        <label for="trading" class="person_checkbox">商社</label>
                        <input type="checkbox" name="desire[]" value="public-corporation" id="public-corporation" />
                        <label for="public-corporation" class="person_checkbox">官公庁・公社</label>
                        <input type="checkbox" name="desire[]" value="retail" id="retail" />
                        <label for="retail" class="person_checkbox">小売</label>
                        <input type="checkbox" name="desire[]" value="finance" id="finance" />
                        <label for="finance" class="person_checkbox">金融</label>
                        <input type="checkbox" name="desire[]" value="service" id="service" />
                        <label for="service" class="person_checkbox">サービス</label>
                        <input type="checkbox" name="desire[]" value="mass-media" id="mass-media" />
                        <label for="mass-media" class="person_checkbox">マスコミ</label>
                        <input type="checkbox" name="desire[]" value="IT" id="IT" />
                        <label for="IT" class="person_checkbox">IT</label>
                        <input type="checkbox" name="desire[]" value="no-decide" id="no-decide" />
                        <label for="no-decide" class="person_checkbox">未定</label>
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