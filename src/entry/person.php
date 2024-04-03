<?php
require_once("../dbconnect.php");
$students = $dbh->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
} else {
    // ユーザーIDはセッションから取得
    $user_id = $_SESSION["user_id"];

    // データベースからユーザーの情報を取得
    $stmt = $dbh->prepare("SELECT * FROM student WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    // フォームが送信された場合の処理
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

        try {
            // データベースに接続

            if (!empty($user_data)) {
                // ユーザーの情報が存在する場合の処理（情報の更新）
                // UPDATE文の実行など
                $sql = "UPDATE student SET name = :name, sub_name = :sub_name, sex = :gender, school = :school, tel_num = :tel_num, mail = :mail, graduation = :graduation, division = :division, desire = :desire WHERE user_id = :user_id";
            } else {
                // ユーザーの情報が存在しない場合の処理（新規登録）
                // INSERT文の実行など
                $sql = "INSERT INTO student (user_id, name, sub_name, sex, school, tel_num, mail, graduation, division, desire) VALUES (:user_id, :name, :sub_name, :gender, :school, :tel_num, :mail, :graduation, :division, :desire)";
            }

            // プリペアドステートメントを作成
            $stmt = $dbh->prepare($sql);

            // プレースホルダに値をバインド
            $stmt->bindParam(':user_id', $user_id);
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

            // リダイレクト
            header("Location: /entry/finalcheck.php");
            exit;
        } catch (PDOException $e) {
            echo "エラー: " . $e->getMessage();
        }

        $division = explode(', ', $user_data['division']);
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
            <form class="person-form" method="POST" action="./person.php">
                <div>
                    <div class="form-tag">
                        <label for="name" class="form-label">お名前</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($user_data['name']) ? $user_data['name'] : ''; ?>" required />
                    </div>
                    <div class="form-tag">
                        <label for="sub_name" class="form-label">フリガナ</label>
                        <input type="text" name="sub_name" id="sub_name" class="form-control" value="<?php echo isset($user_data['sub_name']) ? $user_data['sub_name'] : ''; ?>" required />
                    </div>
                    <div class="form-tag">
                        <label for="sex" class="form-label">性別</label>
                        <input type="radio" name="gender" value="男性" id="male" <?php echo isset($user_data['sex']) && $user_data['sex'] == '男性' ? 'checked' : ''; ?> />
                        <label for="male" class="person_radio" >男性</label>
                        <input type="radio" name="gender" value="女性" id="female" <?php echo isset($user_data['sex']) && $user_data['sex'] == '女性' ? 'checked' : ''; ?>/>
                        <label for="female" class="person_radio"  >女性</label>
                        <input type="radio" name="gender" value="回答しない" id="none" <?php echo isset($user_data['sex']) && $user_data['sex'] == '回答しない' ? 'checked' : ''; ?>/>
                        <label for="none" class="person_radio"  >回答しない</label>
                    </div>
                    <div class="form-tag">
                        <label for="school" class="form-label">学校名</label>
                        <input type="text" name="school" id="school" class="form-control" value="<?php echo isset($user_data['school']) ? $user_data['school'] : ''; ?>" />
                    </div>
                    <div class="form-tag">
                        <label for="phone" class="form-label">携帯電話番号</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?php echo isset($user_data['tel_num']) ? $user_data['tel_num'] : ''; ?>"required />
                    </div>
                    <div class="form-tag">
                        <label for="e-mail" class="form-label">メールアドレス</label>
                        <input type="text" name="e-mail" id="e-mail" class="form-control" value="<?php echo isset($user_data['mail']) ? $user_data['mail'] : ''; ?>" required />
                    </div>
                    <div class="form-tag">
                    <label for="graduation-year" class="form-label">卒業年度</label>
                    <input type="radio" name="graduation_year" value="2025" id="graduation-2025" <?php echo isset($user_data['graduation']) && $user_data['graduation'] == '2025' ? 'checked' : ''; ?> />
                    <label for="graduation-2025" class="person_radio">2025年卒</label>
                    <input type="radio" name="graduation_year" value="2026" id="graduation-2026" <?php echo isset($user_data['graduation']) && $user_data['graduation'] == '2026' ? 'checked' : ''; ?> />
                    <label for="graduation-2026" class="person_radio">2026年卒</label>
                    <input type="radio" name="graduation_year" value="2027" id="graduation-2027" <?php echo isset($user_data['graduation']) && $user_data['graduation'] == '2027' ? 'checked' : ''; ?> />
                    <label for="graduation-2027" class="person_radio">2027年卒</label>
                    <input type="radio" name="graduation_year" value="その他" id="graduation-else" <?php echo isset($user_data['graduation']) && $user_data['graduation'] == 'その他' ? 'checked' : ''; ?> />
                    <label for="graduation-else" class="person_radio">その他</label>
                    </div>


                    <div class="form-tag">
                        <label for="classification" class="form-label">文理区分</label>
                    </div>
                    <div class="form-tagContent">
                        <input type="checkbox" name="division[]" value="文学系" id="literature" <?php echo isset($user_data['division']) && in_array('文学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="literature" class="person_checkbox">文学系</label>
                        <input type="checkbox" name="division[]" value="教育学系" id="education" <?php echo isset($user_data['division']) && in_array('教育学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="education" class="person_checkbox">教育学系</label>
                        <input type="checkbox" name="division[]" value="心理学系" id="psychology" <?php echo isset($user_data['division']) && in_array('心理学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="psychology" class="person_checkbox">心理学系</label>
                        <input type="checkbox" name="division[]" value="言語学系" id="linguistics" <?php echo isset($user_data['division']) && in_array('言語学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="linguistics" class="person_checkbox">言語学系</label>
                        <input type="checkbox" name="division[]" value="政治学系" id="politics" <?php echo isset($user_data['division']) && in_array('政治学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="politics" class="person_checkbox">政治学系</label>
                        <input type="checkbox" name="division[]" value="経済学系" id="economics" <?php echo isset($user_data['division']) && in_array('経済学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="economics" class="person_checkbox">経済学系</label>
                        <input type="checkbox" name="division[]" value="法律学系" id="law" class="form-control" <?php echo isset($user_data['division']) && in_array('法律学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="law" class="person_checkbox">法律学系</label>
                        <input type="checkbox" name="division[]" value="経営学系" id="management" <?php echo isset($user_data['division']) && in_array('経営学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="management" class="person_checkbox">経営学系</label>
                        <input type="checkbox" name="division[]" value="理学系" id="science" <?php echo isset($user_data['division']) && in_array('理学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="science" class="person_checkbox">理学系</label>
                        <input type="checkbox" name="division[]" value="工学系" id="engineering" <?php echo isset($user_data['division']) && in_array('工学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="engineering" class="person_checkbox">工学系</label>
                        <input type="checkbox" name="division[]" value="薬学系" id="pharmacy" <?php echo isset($user_data['division']) && in_array('薬学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="pharmacy" class="person_checkbox">薬学系</label>
                        <input type="checkbox" name="division[]" value="医学系" id="medicine" <?php echo isset($user_data['division']) && in_array('医学系', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="medicine" class="person_checkbox">医学系</label>
                        <input type="checkbox" name="division[]" value="その他" id="others" <?php echo isset($user_data['division']) && in_array('その他', (array)$user_data['division']) ? 'checked' : ''; ?>/>
                        <label for="others" class="person_checkbox">その他</label>
                    </div>
                    <div class="form-tag">
                        <label for="classification" class="form-label" class="person_checkbox">志望業界</label>
                    </div>
                    <div class="form-tagContent">
                        <input type="checkbox" name="desire[]" value="メーカー" id="maker" />
                        <label for="maker" class="person_checkbox">メーカー</label>
                        <input type="checkbox" name="desire[]" value="商社" id="trading" />
                        <label for="trading" class="person_checkbox">商社</label>
                        <input type="checkbox" name="desire[]" value="官公庁・公社" id="public-corporation" />
                        <label for="public-corporation" class="person_checkbox">官公庁・公社</label>
                        <input type="checkbox" name="desire[]" value="小売" id="retail" />
                        <label for="retail" class="person_checkbox">小売</label>
                        <input type="checkbox" name="desire[]" value="金融" id="finance" />
                        <label for="finance" class="person_checkbox">金融</label>
                        <input type="checkbox" name="desire[]" value="サービス" id="service" />
                        <label for="service" class="person_checkbox">サービス</label>
                        <input type="checkbox" name="desire[]" value="マスコミ" id="mass-media" />
                        <label for="mass-media" class="person_checkbox">マスコミ</label>
                        <input type="checkbox" name="desire[]" value="IT" id="IT" />
                        <label for="IT" class="person_checkbox">IT</label>
                        <input type="checkbox" name="desire[]" value="未定" id="no-decide" />
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