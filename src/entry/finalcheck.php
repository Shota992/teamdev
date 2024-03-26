<!-- 書き方1 -->
<?php
require __DIR__ . '/../dbconnect.php';

// POSTリクエストが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // トランザクション開始
        $dbh->beginTransaction();
        
        // ユーザーが選択した企業の情報を取得するクエリを実行
        $sql_companies = "SELECT * FROM choice JOIN info ON choice.agent_id = info.agent_id WHERE choice.user_id = 1"; // ここで適切なユーザーIDを指定する必要があります
        $stmt_companies = $dbh->prepare($sql_companies);
        $stmt_companies->execute();
        $chosen_companies = $stmt_companies->fetchAll(PDO::FETCH_ASSOC);

        // 個人情報を取得するクエリを実行
        $sql_personal = "SELECT * FROM student WHERE user_id = 1"; // ここで適切なユーザーIDを指定する必要があります
        $stmt_personal = $dbh->prepare($sql_personal);
        $stmt_personal->execute();
        $personal_info = $stmt_personal->fetch(PDO::FETCH_ASSOC);

        // メールアドレスを取得するクエリを実行
        $sql_email = "SELECT mail FROM agent";
        $stmt_email = $dbh->prepare($sql_email);
        $stmt_email->execute();
        $emails = $stmt_email->fetchAll(PDO::FETCH_COLUMN);

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

        // トランザクションコミット
        $dbh->commit();
        exit; // リダイレクト後に実行が継続されないようにする
    } catch (PDOException $e) {
        // トランザクションロールバック
        $dbh->rollBack();
        // エラーメッセージを出力
        echo "申し込みに失敗しました：" . $e->getMessage();
    }
}
?>


<!-- 書き方2 -->
<?php
// require __DIR__ . '/../dbconnect.php';
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // MySQLに接続するための情報
//     $servername = "db";
//     $username = "root";
//     $password = "root";
//     $dbname = "posse";

//     // MySQLに接続する
//     $conn = new mysqli($servername, $username, $password, $dbname);

//     // 接続をチェックする
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     // var_dump("aaaaaaa");

//     // ユーザーが選択した企業の情報を取得するクエリを実行する
//     $sql_companies = "SELECT * FROM choice JOIN info ON choice.agent_id = info.agent_id WHERE choice.user_id = 1"; // ここで適切なユーザーIDを指定する必要があります
//     $result_companies = $conn->query($sql_companies);

//     $chosen_companies = array(); // 選択した企業の情報を格納する配列

//     if ($result_companies && $result_companies->num_rows > 0) {
//         while ($row = $result_companies->fetch_assoc()) {
//             $chosen_companies[] = $row;
//         }
//     }

    


//     // 個人情報を取得するクエリを実行する
//     $sql_personal = "SELECT * FROM student WHERE user_id = 1"; // ここで適切なユーザーIDを指定する必要があります
//     $result_personal = $conn->query($sql_personal);

//     $personal_info = array(); // 個人情報を格納する配列

//     if ($result_personal->num_rows > 0) {
//         while ($row = $result_personal->fetch_assoc()) {
//             $personal_info = $row;
//         }
//     }


//     // メールアドレスを取得するクエリを実行する
//     $sql = "SELECT mail FROM agent";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // 結果からデータを取得し、配列に格納する
//         $emails = array();
//         while ($row = $result->fetch_assoc()) {
//             $emails[] = $row["mail"];
//         }
//         if ($_SERVER["REQUEST_METHOD"] == "POST") {
//             // 申し込みが完了したら指定のページにリダイレクトする
//             header("Location: /../entry/complete.php");

//             // メールの送信
//             foreach ($emails as $email) {
//                 $to = $email;
//                 $subject = "申し込み通知メール";
//                 $message = "貴エージェント企業様に学生からの申し込みがありました。詳細は管理画面でご確認ください。";
//                 $headers = "From: 1007yanagita@gmail.com" . "\r\n" .
//                             "Reply-To: 1007yanagita@gmail.com" . "\r\n" .
//                             "X-Mailer: PHP/" . phpversion();

//                 // メールを送信
//                 mail($to, $subject, $message, $headers);
//             }
//             exit; // リダイレクト後に実行が継続されないようにする
//         }
//     } else {
//         echo "送信先のメールアドレスが見つかりませんでした。";
//     }

//     // MySQL接続を閉じる
//     $conn->close();

//     // 申し込み完了後の処理（例えば、成功メッセージを表示するなど）
//     echo "申し込みが完了しました。";
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>企業一覧、個人情報の確認</title>
    <link rel="stylesheet" href="../assets/css/entry.css" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body>
    <?php 
    // include_once '../includes/header2.php'; 
    ?>
    <main class="main-body">
        <div class="final-wrapper">
            <div class="final-container">
                <div class="final-inner">
                    <div class="final-company">
                        <div class="final-company-title-container">
                            <p class="final-company-title">
                                申込みした企業：<?php echo count($chosen_companies); ?>社
                            </p>
                        </div>
                        <div class="final-company-table-container">
                            <?php foreach ($chosen_companies as $company) : ?>
                                <div class="final-company-table">
                                    <div class="final-company-item-logo"></div>
                                    <div class="final-company-item-sent">
                                        <div class="final-company-item-service"><?php echo $company['site_name']; ?></div>
                                        <div class="final-company-item-name"><?php echo $company['agent_name']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
                                    <div class="final-person-sent"><?php echo $personal_info['name']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">フリガナ</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['sub_name']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">性別</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['sex']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">携帯電話番号</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['tel_num']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">大学名</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['school']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">メールアドレス</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['mail']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">卒業年度</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['graduation']; ?>年卒</div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">文理区分</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['division']; ?></div>
                                </div>
                            </div>
                            <div class="final-person-table">
                                <div class="final-person-head">
                                    <div class="final-person-sent">志望業界</div>
                                </div>
                                <div class="final-person-item">
                                    <div class="final-person-sent"><?php echo $personal_info['desire']; ?></div>
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