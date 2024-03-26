<?php
session_start();

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力されたデータを取得
    $name = $_POST['name'];
    $sub_name = $_POST['sub_name'];
    $tel_num = $_POST['tel_num'];
    $mail = $_POST['mail'];

    // 必須項目の入力チェック
    if (empty($name) || empty($sub_name) || empty($tel_num) || empty($mail)) {
        // 必須項目が未入力の場合はエラーメッセージを表示して終了
        echo "必須項目が入力されていません。";
        exit;
    }

    // チェックボックスの値を取得し、カンマ区切りの文字列に変換
    $gender = isset($_POST['male']) ? "男性" : (isset($_POST['female']) ? "女性" : "回答しない");
    $graduation = isset($_POST['2025']) ? "2025年卒" : (isset($_POST['2026']) ? "2026年卒" : (isset($_POST['2027']) ? "2027年卒" : "その他"));
    $division = implode(", ", array_filter(array(
        isset($_POST['literature']) ? "文学系" : null,
        isset($_POST['education']) ? "教育学系" : null,
        isset($_POST['psychology']) ? "心理学系" : null,
        isset($_POST['linguistics']) ? "言語学系" : null,
        isset($_POST['politics']) ? "政治学系" : null,
        isset($_POST['economics']) ? "経済学系" : null,
        isset($_POST['law']) ? "法律学系" : null,
        isset($_POST['management']) ? "経営学系" : null,
        isset($_POST['science']) ? "理学系" : null,
        isset($_POST['engineering']) ? "工学系" : null,
        isset($_POST['pharmacy']) ? "薬学系" : null,
        isset($_POST['medicine']) ? "医学系" : null,
        isset($_POST['others']) ? "その他" : null
    )));
    $desire = implode(", ", array_filter(array(
        isset($_POST['maker']) ? "メーカー" : null,
        isset($_POST['trading']) ? "商社" : null,
        isset($_POST['public-corporation']) ? "官公庁・公社" : null,
        isset($_POST['retail']) ? "小売" : null,
        isset($_POST['finance']) ? "金融" : null,
        isset($_POST['service']) ? "サービス" : null,
        isset($_POST['mass-media']) ? "マスコミ" : null,
        isset($_POST['IT']) ? "IT" : null,
        isset($_POST['no-decide']) ? "未定" : null
    )));

    // セッションに値を保存
    $_SESSION['temp_student_data'] = array(
        'name' => $name,
        'sub_name' => $sub_name,
        'gender' => $gender,
        'tel_num' => $tel_num,
        'mail' => $mail,
        'graduation' => $graduation,
        'division' => $division,
        'desire' => $desire
    );

    // データベースに接続
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続をチェック
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // データベースにデータを保存
    $sql = "INSERT INTO student (name, sub_name, sex, tel_num, mail, graduation, division, desire)
            VALUES ('$name', '$readname', '$gender', '$phone', '$email', '$graduation', '$division', '$desire')";

    if ($conn->query($sql) === TRUE) {
        echo "新しいレコードが正常に作成されました。";
    } else {
        echo "エラー: " . $sql . "<br>" . $conn->error;
    }

    // データベース接続を閉じる
    $conn->close();

    // 申し込み完了後の処理（例えば、成功メッセージを表示するなど）
    echo "申し込みが完了しました。";

    exit; // フォームの処理が完了したら終了
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
                        <label for="readname" class="form-label">フリガナ</label>
                        <input type="text" name="readname" id="readname" class="form-control" required />
                    </div>
                    <div class="form-tag">
                        <label for="" class="form-label">性別</label>
                        <input type="checkbox" name="male" id="male"  class="person_checkbox"/>
                        <label for="male">男性</label>
                        <input type="checkbox" name="female" id="female" class="person_checkbox"/>
                        <label for="female">女性</label>
                        <input type="checkbox" name="none" id="none" class="person_checkbox"/>
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
                        <label for="male" class="person_checkbox">2025年卒</label>
                        <input type="checkbox" name="2026" id="2026" />
                        <label for="male" class="person_checkbox">2026年卒</label>
                        <input type="checkbox" name="2027" id="2027" />
                        <label for="male" class="person_checkbox">2027年卒</label>
                        <input type="checkbox" name="else" id="else" />
                        <label for="male" class="person_checkbox">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label">文理区分</label>
                        <input type="checkbox" name="literature" id="literature" class="person_checkbox"/>
                        <label for="literature" >文学系</label>
                        <input type="checkbox" name="education" id="education" class="person_checkbox"/>
                        <label for="education">教育学系</label>
                        <input type="checkbox" name="psychology" id="psychology" class="person_checkbox"/>
                        <label for="psychology">心理学系</label>
                        <input type="checkbox" name="linguistics" id="linguistics" class="person_checkbox"/>
                        <label for="linguistics">言語学系</label>
                        <input type="checkbox" name="politics" id="politics" class="person_checkbox"/>
                        <label for="politics">政治学系</label>
                        <input type="checkbox" name="economics" id="economics" class="person_checkbox"/>
                        <label for="economics">経済学系</label>
                        <input type="checkbox" name="law" id="law" class="form-control" class="person_checkbox"/>
                        <label for="law">法律学系</label>
                        <input type="checkbox" name="management" id="management" class="person_checkbox"/>
                        <label for="management">経営学系</label>
                        <input type="checkbox" name="science" id="science" class="person_checkbox"/>
                        <label for="science">理学系</label>
                        <input type="checkbox" name="engineering" id="engineering" class="person_checkbox"/>
                        <label for="engineering">工学系</label>
                        <input type="checkbox" name="pharmacy" id="pharmacy" class="person_checkbox"/>
                        <label for="pharmacy">薬学系</label>
                        <input type="checkbox" name="medicine" id="medicine" class="person_checkbox"/>
                        <label for="medicine">医学系</label>
                        <input type="checkbox" name="others" id="others" class="person_checkbox"/>
                        <label for="others">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label">志望業界</label>
                        <input type="checkbox" name="maker" id="maker" class="person_checkbox"/>
                        <label for="maker">メーカー</label>
                        <input type="checkbox" name="trading" id="trading" class="person_checkbox"/>
                        <label for="trading">商社</label>
                        <input type="checkbox" name="public-corporation" id="public-corporation" class="person_checkbox"/>
                        <label for="public-corporation">官公庁・公社</label>
                        <input type="checkbox" name="retail" id="retail" class="person_checkbox"/>
                        <label for="retail">小売</label>
                        <input type="checkbox" name="finance" id="finance" class="person_checkbox"/>
                        <label for="finance">金融</label>
                        <input type="checkbox" name="service" id="service" class="person_checkbox"/>
                        <label for="service" >サービス</label>
                        <input type="checkbox" name="mass-media" id="mass-media" class="person_checkbox"/>
                        <label for="mass-media" >マスコミ</label>
                        <input type="checkbox" name="IT" id="IT"class="person_checkbox" />
                        <label for="IT">IT</label>
                        <input type="checkbox" name="no-decide" id="no-decide" class="person_checkbox"/>
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