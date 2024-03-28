<?php
session_start();
require_once '../../dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // POSTリクエストからデータを取得
    $site_name = $_POST['site-name'] ?? '';
    $agent_name = $_POST['agent-name'] ?? '';
    $explanation = $_POST['agent-overview'] ?? '';
    $type = $_POST['agent-kinds'] ?? '';
    $size = $_POST['agent-scale'] ?? '';
    $area = $_POST['region'] ?? '';
    $amounts = $_POST['job-opening'] ?? '';
    // $_POST['category'] の値が存在するかどうかをチェック
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    // $_POST['category'] の値が配列であることを確認
    if (is_array($category)) {
        $category = implode(',', $category);
    } else {
        $category = ''; // もしくは適切なデフォルト値を設定する
    }
    $url = $_POST['agent-url'] ?? '';
    $email = $_POST['agent-email'] ?? '';

    // アップロード先ディレクトリのパス
$upload_directory = "uploads/";

// アップロード先ディレクトリが存在しない場合は作成する
if (!file_exists($upload_directory)) {
    mkdir($upload_directory, 0755, true); // 0755 は一般的なパーミッション設定です
}

    // ファイルのアップロード処理
    $uploadOk = 1;
    $target_file = "";
    $imageFileType = "";
    $upload_error_message = "";

    if (!empty($_FILES["agent-logo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["agent-logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ファイルが正しくアップロードされたかどうかを確認
        $check = getimagesize($_FILES["agent-logo"]["tmp_name"]);
        if ($check === false) {
            $upload_error_message = "ファイルは画像ではありません。";
            $uploadOk = 0;
        }

        // ファイルがすでに存在するかどうかを確認し、存在していればアップロードしない
        if (file_exists($target_file)) {
            $upload_error_message = "すみません、ファイルは既に存在しています。";
            $uploadOk = 0;
        }

        // 特定のファイル形式のみを許可
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $upload_error_message = "すみません、JPG, JPEG, PNG & GIFファイルのみがアップロード可能です。";
            $uploadOk = 0;
        }

        // アップロードが許可されているかどうかを確認し、許可されている場合はファイルを移動
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["agent-logo"]["tmp_name"], $target_file)) {
                echo "ファイル " . htmlspecialchars(basename($_FILES["agent-logo"]["name"])) . " がアップロードされました。";
            } else {
                $upload_error_message = "ファイルのアップロード中にエラーが発生しました。";
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk == 0) {
        // アップロードエラーがある場合はエラーメッセージを表示して処理を終了
        echo $upload_error_message;
        exit;
    }

        // データベースへの接続を確立
        $dbh = new PDO($dsn, $user, $password);

        // PDOエラーモードを例外モードに設定
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQLクエリを準備

        $stmt = $dbh->prepare("INSERT INTO info (site_name, agent_name, logo, explanation, type, size, area, amounts, category, url, email) VALUES (:site_name, :agent_name, :logo, :explanation, :type, :size, :area, :amounts, :category, :url, :email)");

        // パラメータを割り当ててクエリを実行
        $stmt->bindParam(':site_name', $site_name);
        $stmt->bindParam(':agent_name', $agent_name);
        $stmt->bindParam(':logo', $target_file);
        $stmt->bindParam(':explanation', $explanation);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':amounts', $amounts);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':email', $email);

        // クエリを実行し、データを挿入
        $stmt->execute();

        // データベース接続をクローズ
        $dbh = null;
        // リダイレクト先のURLを設定
        $redirect_url = "/Cadmin/index.php";
        // リダイレクト
        header("Location: $redirect_url");
        exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業新規登録画面</title>
    <link rel="stylesheet" href="../../assets/css/reset.css">
    <link rel="stylesheet" href="../../Cadmin/Cadmin.css">
</head>

<body>
    <header class="header-all">
        <div header-top>
            <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
                <img src="../../assets/img/header_logo.png" alt="CRAFT" width="120" style="object-fit: contain;">
            </a>
        </div>
        <div class="header-down">
            <img src="../../assets/img/boozer_logo-black.png" alt="boozer" width="150" style="object-fit: contain;">
        </div>
    </header>
    <div class="create-wrapper">
        <aside class="create_side-container">
            <nav>
                <div class="side-sent">
                    <div class="side-content"><a href="../../Cadmin/index.php">エージェント企業一覧</a></div>
                    <div class="side-content"><a href="/">エージェント企業新規登録</a></div>
                    <div class="side-choiced"><a href="../../Cadmin/auth/newadmin.php"></a>新規管理者登録
                        </a>
                    </div>
                    <div class="side-content"><a href="../../Cadmin/content.php">申込内容一覧</a></div>
                    <div class="side-content"><a href="../../Cadmin/auth/logout.php">ログアウト</a></div>
                </div>
            </nav>
        </aside>
        <main class="create-main">
            <div>
                <h1 class="create-title">エージェント企業新規登録</h1>
            </div>
            <div class="create-container">
                <form action="" class="" method="POST" enctype="multipart/form-data">
                    <table class="table-res-form">
                        <div class="create-list">
                            <tr>
                                <th><label for="site-name" class="create_form-label">サービス名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="site-name" id="site-name" class="form-control" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-name" class="create_form-label">企業名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-name" id="agent-name" class="form-control" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-logo" class="create_form-labelLogo">企業ロゴ</label>
                                </th>
                                <td class="create_td1a"><input type="file" name="agent-logo" id="agent-logo" class="form-control1" /><!--<button type="submit" class="reference">参照</button>-->
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-overview" class="create_form-label">企業の概要 <br>（50文字以内）</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-overview" id="agent-overview" class="form-control" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-kinds" class="create_form-label">企業種類</label>
                                </th>
                                <td class="create_td2">
                                    <select name="agent-kinds" class="create_select">
                                        <option>総合型</option>
                                        <option>特化型</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-scale" class="create_form-label">企業規模</label>
                                </th>
                                <td class="create_td2">
                                    <select name="agent-scale" class="create_select">
                                        <option>大企業</option>
                                        <option>中・小企業</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="region" class="create_form-label">地域</label>
                                </th>
                                <td class="create_td2">
                                    <select name="region" class="create_select">
                                        <option>東京都</option>
                                        <option>全国</option>
                                        <option>地方</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="job-opening" class="create_form-label">求人数</label>
                                </th>
                                <td class="create_td1" style="display: flex; align-items: end;"><input type="text" name="job-opening" id="job-opening" class="form-control" />
                                    <strong>社</strong>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="category" class="create_form-label">カテゴリ</label>
                                </th>
                                <td class="create_td1">
                                    <div class="form-tag" style="column-count: 4; text-align: left;">
                                        <input type="checkbox" name="category[]" value="営業" id="category1" />
                                        <label for="category1" class="create_checkbox">営業</label>
                                        <input type="checkbox" name="category[]" value="IT" id="category2" />
                                        <label for="category2" class="create_checkbox">IT</label>
                                        <input type="checkbox" name="category[]" value="Web" id="category3" />
                                        <label for="category3" class="create_checkbox">Web</label>
                                        <input type="checkbox" name="category[]" value="税理士" id="category4" />
                                        <label for="category4" class="create_checkbox">税理士</label>
                                        <input type="checkbox" name="category[]" value="会計士" id="category5" />
                                        <label for="category5" class="create_checkbox">会計士</label>
                                        <input type="checkbox" name="category[]" value="介護職" id="category6" />
                                        <label for="category6" class="create_checkbox">介護職</label>
                                        <input type="checkbox" name="category[]" value="リハビリ" id="category7" />
                                        <label for="category7" class="create_checkbox">リハビリ</label>
                                        <input type="checkbox" name="category[]" value="保育士" id="category8" />
                                        <label for="category8" class="create_checkbox">保育士</label>
                                        <input type="checkbox" name="category[]" value="看護師" id="category9" />
                                        <label for="category9" class="create_checkbox">看護師</label>
                                        <input type="checkbox" name="category[]" value="女性" id="category10" />
                                        <label for="category10" class="create_checkbox">女性</label>
                                        <input type="checkbox" name="category[]" value="外資系" id="category11" />
                                        <label for="category11" class="create_checkbox">外資系</label>
                                    </div>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-url" class="create_form-label">企業HPのURL</label>
                                </th>
                                <td class="create_td1">
                                    <input type="text" name="agent-url" id="agent-url" class="form-control" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-email" class="crate_form-label">メールアドレス</label>
                                </th>
                                <td class="create_td1"><input type="email" name="agent-email" id="agent-email" class="form-control" />
                                </td>
                            </tr>
                        </div>
                    </table>
                    <div class="keep">
                        <div class="create_btn">
                            <button type="submit">保存</button>
                        </div>
                    </div>
                    <div class="create_sample">
                        <p class="create_sampleP"> サンプル　学生側には以下のように表示されます</p>
                        <div class="create_sample-figure" style="width: 270.667px;">
                            <div class="slider-img">
                                <img src="" alt="">
                            </div>
                            <div class="slider-titles">
                                <p class="slider-title">企業名</p>
                            </div>
                            <div class="slider-tags">
                                <div class="slider-tag big">
                                    <p class="slider-tagsent">大手</p>
                                </div>
                                <div class="slider-tag small">
                                    <p class="slider-tagsent">中小</p>
                                </div>
                            </div>
                            <div class="slider-contents">
                                <p>aaaaaaaaaaaaa</p>
                                <p>aaaaaaaaaaaaa</p>
                                <p>aaaaaaaaaaaaa</p>
                                <p>aaaaaaaaaaaaa</p>
                            </div>
                            </di=>
                        </div>
                        <button type="submit" class="create_btn">新規登録</button>
                    </div>
            </div>
        </main>
    </div>
    <footer>
        <div class="footer-copyright">
            <small>&copy; POSSE,Inc</small>
        </div>
    </footer>
</body>

</html>