<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // MySQLに接続するための情報
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "posse";

    // MySQLに接続する
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続をチェックする
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // メールアドレスを取得するクエリを実行する
    $sql = "SELECT mail FROM agent";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 結果からデータを取得し、配列に格納する
        $emails = array();
        while ($row = $result->fetch_assoc()) {
            $emails[] = $row["mail"];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // 申し込みが完了したら指定のページにリダイレクトする
            header("Location: /../entry/complete.php");

            // メールの送信
            foreach ($emails as $email) {
                $to = $email;
                $subject = "申し込み通知メール";
                $message = "貴エージェント企業様に学生からの申し込みがありました。詳細は管理画面でご確認ください。";
                $headers = "From: 1007yanagita@gmail.com" . "\r\n" .
                            "Reply-To: 1007yanagita@gmail.com" . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();

                // メールを送信
                mail($to, $subject, $message, $headers);
            }
            exit; // リダイレクト後に実行が継続されないようにする
        }
    } else {
        echo "送信先のメールアドレスが見つかりませんでした。";
    }

    // MySQL接続を閉じる
    $conn->close();

    // 申し込み完了後の処理（例えば、成功メッセージを表示するなど）
    echo "申し込みが完了しました。";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finalcheck</title>
    <link rel="stylesheet" href="../assets/css/entry.css" />
    <link rel="stylesheet" href="../assets/sp/sp-finalcheck.css">
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php include_once '../includes/header2.php'; ?>
    <main class="main-body">
        <div class="final-wrapper">
            <div class="final-container">
                <div class="final-inner">
                    <div class="final-company">
                        <div class="final-company-title-container">
                            <p class="final-company-title">
                                申込みした企業：3社
                            </p>
                        </div>
                        <div class="final-company-table-container">
                            <div class="final-company-table">
                                <div class="final-company-item-logo"></div>
                                <div class="final-company-item-sent">
                                    <div class="final-company-item-service">doda</div>
                                    <div class="final-company-item-name">パーソナルキャリア株式会社</div>
                                </div>
                            </div>
                            <div class="final-company-table">
                                <div class="final-company-item-logo"></div>
                                <div class="final-company-item-sent">
                                    <div class="final-company-item-service">doda</div>
                                    <div class="final-company-item-name">パーソナルキャリア株式会社</div>
                                </div>
                            </div>
                            <div class="final-company-table">
                                <div class="final-company-item-logo"></div>
                                <div class="final-company-item-sent">
                                    <div class="final-company-item-service">doda</div>
                                    <div class="final-company-item-name">パーソナルキャリア株式会社</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="final-person">
                        <div class="final-person-title-container">
                            <div class="final-person-title">
                                入力された個人情報
                            </div>
                        </div>
                        <div class="final-person-table-container">
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">お名前</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">倉　富戸</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">フリガナ</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">クラ　フト</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">性別</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">男</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">携帯電話番号</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">000-000-000</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">メールアドレス</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">ccc@ccc.com</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">卒業年度</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">2025年卒</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">文理区分</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">情報系</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">志望業界</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent">IT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="final-submit">
                        <div class="final-submit-container">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <button class="final-submit-button">申し込む</button>
                            </form>    
                        </div>
                        <div class="final-edit-container">
                            <button class="final-edit-button">入力内容を変更する</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once '../includes/footer1.php';
    ?>
</body>
</html>