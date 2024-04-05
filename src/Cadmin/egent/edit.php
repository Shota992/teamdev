<?php
require __DIR__ . '/../../dbconnect.php';
require __DIR__ . '/../../vendor/autoload.php';

use Verot\Upload\Upload;

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: /../../../Cadmin/auth/login.php');
    exit;
}

if (!isset($_GET['agent_id'])) {
    exit("IDが指定されていません。");
}

$agent_id = $_GET['agent_id'];

$sql = "SELECT * FROM info WHERE agent_id = :agent_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(":agent_id", $agent_id);
$stmt->execute();
$info = $stmt->fetch();

$image_name = ""; // 画像名を空の文字列で初期化

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbh->beginTransaction();

        $file = $_FILES['agent-logo'];
        $lang = 'ja_JP';

        if (!empty($file['name'])) {
            $handle = new Upload($file, $lang);

            if (!$handle->uploaded) {
                throw new Exception($handle->error);
            }

            // ファイルサイズのバリデーション： 5MB
            $handle->file_max_size = '5120000';
            // ファイルの拡張子と MIMEタイプをチェック
            $handle->allowed = array('image/jpeg', 'image/png', 'image/gif');
            // PNGに変換して拡張子を統一
            $handle->image_convert = 'png';
            $handle->file_new_name_ext = 'png';
            // サイズ統一
            $handle->image_resize = true;
            $handle->image_x = 300;
            // アップロードディレクトリを指定して保存
            $handle->process('../egent/uploads/');
            if (!$handle->processed) {
                throw new Exception($handle->error);
            }

            // 更新前の画像を削除
            if ($info && isset($info["agent-logo"])) {
                $image_path = __DIR__ . '/../egent/uploads/' . $info["agent-logo"];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $image_name = $handle->file_dst_name;
        }

        // 企業レコードの更新
        $sql = "UPDATE info SET site_name = :site_name, agent_name = :agent_name, logo = :logo, explanation = :explanation, type = :type, size = :size, area = :area, amounts = :amounts, category = :category, url = :url, email = :email WHERE agent_id = :agent_id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":agent_id", $agent_id);
        $stmt->bindValue(":site_name", $_POST["site_name"]);
        $stmt->bindValue(":agent_name", $_POST["agent-name"]);
        $stmt->bindValue(":logo", $image_name);
        $stmt->bindValue(":explanation", $_POST["agent-overview"]);
        $stmt->bindValue(":type", $_POST["agent-kinds"]);
        $stmt->bindValue(":size", $_POST["agent-scale"]);
        $stmt->bindValue(":area", $_POST["region"]);
        $stmt->bindValue(":amounts", $_POST["job-opening"]);
        $stmt->bindValue(":category", implode(',', $_POST["category"]));
        $stmt->bindValue(":url", $_POST["agent-url"]);
        $stmt->bindValue(":email", $_POST["agent-email"]);

        $stmt->execute(); // SQL実行

        $dbh->commit();
        $_SESSION['message'] = "エージェント企業編集に成功しました。";
        header('Location:http://localhost:8080/Cadmin/index.php');
        exit;
    } catch (PDOException $e) {
        $dbh->rollBack();
        $_SESSION['message'] = "エージェント企業編集に失敗しました。";
        error_log($e->getMessage());
        exit;
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        error_log($e->getMessage());
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業編集画面</title>
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
        <aside class="side-container">
            <nav>
                <div class="side-sent">
                    <div class="side-content"><a href="../../Cadmin/index.php">エージェント企業一覧</a></div>
                    <div class="side-content"><a href="../../Cadmin/egent/create.php">エージェント企業新規登録</a></div>
                    <div class="side-content"><a href="../../Cadmin/auth/newadmin.php">新規管理者登録</a></div>
                    <div class="side-content"><a href="../../Cadmin/content.php">申込内容一覧</a></div>
                    <div class="side-content"><a href="../../Cadmin/auth/logout.php">ログアウト</a></div>
                </div>
            </nav>
        </aside>
        <main class="create-main">
            <div>
                <h1 class="create-title">エージェント企業編集</h1>
            </div>
            <div class="create-container">
                <form action="" class="" method="POST" enctype="multipart/form-data">
                    <table class="table-res-form">
                        <div class="create-list">
                            <tr>
                                <th><label for="site_name" class="create_form-label">サービス名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="site_name" id="site_name" class="form-control" value="<?= $info["site_name"] ?>" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-name" class="create_form-label">企業名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-name" id="agent-name" class="form-control" value="<?= $info["agent_name"] ?>" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-logo" class="create_form-labelLogo">企業ロゴ</label>
                                </th>
                                <td class="create_td1a"><input type="file" name="agent-logo" id="agent-logo" class="form-control1" />
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-overview" class="create_form-label">企業の概要 <br>（50文字以内）</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-overview" id="agent-overview" class="form-control"  value="<?= $info["explanation"] ?>"/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-kinds" class="create_form-label">企業種類</label>
                                </th>
                                <td class="create_td2">
                                    <select name="agent-kinds" class="create_select">
                                        <option <?= ($info["type"] == "総合") ? "selected" : "" ?>>総合型</option>
                                        <option <?= ($info["type"] == "特化") ? "selected" : "" ?>>特化型</option>
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
                                        <option <?= ($info["size"] == "大手") ? "selected" : "" ?>>大企業</option>
                                        <option <?= ($info["size"] == "中小") ? "selected" : "" ?>>中・小企業</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="region" class="create_form-label">地域</label>
                                </th>
                                <td class="create_td1">
                                    <input type="text" name="region" id="region" class="form-control required"  value="<?= $info["area"] ?>"/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="job-opening" class="create_form-label">求人数</label>
                                </th>
                                <td class="create_td1" style="display: flex; align-items: end;"><input type="text" name="job-opening" id="job-opening" class="form-control required" value="<?= $info["amounts"] ?>"/>
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
                                    <?php
                                    $categories = explode(',', $info["category"]); // カテゴリはカンマ区切りの文字列なので、explode関数を使って配列に変換
                                    ?>
                                        <input type="checkbox" name="category[]" value="営業" id="category1" <?= (in_array("営業", $categories)) ? "checked" : "" ?>/>
                                        <label for="category1" class="create_checkbox">営業</label>
                                        <input type="checkbox" name="category[]" value="IT" id="category2" <?= (in_array("IT", $categories)) ? "checked" : "" ?>/>
                                        <label for="category2" class="create_checkbox">IT</label>
                                        <input type="checkbox" name="category[]" value="Web" id="category3" <?= (in_array("Web", $categories)) ? "checked" : "" ?>/>
                                        <label for="category3" class="create_checkbox">Web</label>
                                        <input type="checkbox" name="category[]" value="税理士" id="category4" <?= (in_array("税理士", $categories)) ? "checked" : "" ?>/>
                                        <label for="category4" class="create_checkbox">税理士</label>
                                        <input type="checkbox" name="category[]" value="会計士" id="category5" <?= (in_array("会計士", $categories)) ? "checked" : "" ?>/>
                                        <label for="category5" class="create_checkbox">会計士</label>
                                        <input type="checkbox" name="category[]" value="介護職" id="category6" <?= (in_array("介護職", $categories)) ? "checked" : "" ?>/>
                                        <label for="category6" class="create_checkbox">介護職</label>
                                        <input type="checkbox" name="category[]" value="リハビリ" id="category7" <?= (in_array("リハビリ", $categories)) ? "checked" : "" ?>/>
                                        <label for="category7" class="create_checkbox">リハビリ</label>
                                        <input type="checkbox" name="category[]" value="保育士" id="category8" <?= (in_array("保育士", $categories)) ? "checked" : "" ?>/>
                                        <label for="category8" class="create_checkbox">保育士</label>
                                        <input type="checkbox" name="category[]" value="看護師" id="category9" <?= (in_array("看護師", $categories)) ? "checked" : "" ?>/>
                                        <label for="category9" class="create_checkbox">看護師</label>
                                        <input type="checkbox" name="category[]" value="女性" id="category10" <?= (in_array("女性", $categories)) ? "checked" : "" ?>/>
                                        <label for="category10" class="create_checkbox">女性</label>
                                        <input type="checkbox" name="category[]" value="外資系" id="category11" <?= (in_array("外資系", $categories)) ? "checked" : "" ?>/>
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
                                    <input type="text" name="agent-url" id="agent-url" class="form-control required" value="<?= $info["url"] ?>"/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-email" class="crate_form-label">メールアドレス</label>
                                </th>
                                <td class="create_td1"><input type="email" name="agent-email" id="agent-email" class="form-control required" value="<?= $info["email"] ?>"/>
                                </td>
                            </tr>
                        </div>
                    </table>
                    <div class="create_sample">
                        <button type="submit" class="create_btn">完了</button>
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