<?php
require_once('../../dbconnect.php');
require "../../vendor/autoload.php";
use Verot\Upload\Upload;

//セッションの開始
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // ファイルアップロード処理
        $file = $_FILES['agent_logo'];
        $lang = 'ja_JP';

        // アップロードされたファイルを渡す
        $handle = new Upload($file, $lang);

        //ファイルサイズのバリデーション： 5MB
        $handle->file_max_size = '5120000';
        // ファイルの拡張子と MIMEタイプをチェック
        $handle->allowed = array('image/jpeg', 'image/png', 'image/gif');

        if ($handle->uploaded) {
            // PNGに変換して拡張子を統一
            $handle->image_convert = 'png';
            $handle->file_new_name_ext = 'png';
            // サイズ統一
            $handle->image_resize = true;
            $handle->image_x = 300;

            // アップロードディレクトリを指定して保存
            $handle->process('../../assets/img/');
            $image_name = $handle->file_dst_name;
        } else {
            // アップロード失敗
            throw new Exception($handle->error);
        }

        // ファイルアップロードのバリデーション
        if (!isset($_FILES['agent_logo']) || $_FILES['agent_logo']['error'] != UPLOAD_ERR_OK) {
            throw new Exception("ファイルがアップロードされていない、またはアップロードでエラーが発生しました。");
        }

        // ファイルサイズのバリデーション
        if ($_FILES['agent_logo']['size'] > 5000000) {
            throw new Exception("ファイルサイズが大きすぎます。");
        }

        // 許可された拡張子かチェック
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
        $file_parts = explode('.', $_FILES['agent_logo']['name']);
        $file_ext = strtolower(end($file_parts));
        if (!in_array($file_ext, $allowed_ext)) {
            throw new Exception("許可されていないファイル形式です。");
        }


        // ファイルの内容が画像であるかをチェック
        $allowed_mime = array('image/jpeg', 'image/png', 'image/gif');
        $file_mime = mime_content_type($_FILES['agent_logo']['tmp_name']);
        if (!in_array($file_mime, $allowed_mime)) {
            throw new Exception("許可されていないファイル形式です。");
        }

        // 一時ファイルパスを取得
        $tmp_file = $_FILES['agent_logo']['tmp_name'];

        // アップロード先のディレクトリ
        $upload_dir = '../../assets/img/';

        // ファイルの移動
        // $target_file = $upload_directory . basename($file['name']);
        // if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        //     throw new Exception("画像のアップロード中にエラーが発生しました。");
        // }

        // エージェント企業情報を取得
        $site_name = $_POST['site-name'];
        $agent_name = $_POST['agent-name'];
        $agent_overview = $_POST['agent-overview'];
        $agent_kinds = isset($_POST['agent-kinds']) ? $_POST['agent-kinds'] : null;
        $agent_scale = isset($_POST['agent-scale']) ? $_POST['agent-scale'] : null;
        $region = $_POST['region'];
        $job_opening = $_POST['job-opening'];
        $categories = isset($_POST['category']) ? implode(", ", $_POST['category']) : '';
        $agent_url = $_POST['agent-url'];
        $agent_email = $_POST['agent-email'];

        // SQL文の準備
        $sql = "INSERT INTO info (site_name, agent_name, logo, explanation, type, size, area, amounts, category, url, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // プリペアドステートメントを作成
        $stmt = $dbh->prepare($sql);

        // パラメータをバインドしてSQLを実行
        $stmt->bindParam(1, $site_name);
        $stmt->bindParam(2, $agent_name);
        $stmt->bindParam(3, $image_name);
        $stmt->bindParam(4, $agent_overview);
        $stmt->bindParam(5, $agent_kinds);
        $stmt->bindParam(6, $agent_scale);
        $stmt->bindParam(7, $region);
        $stmt->bindParam(8, $job_opening);
        $stmt->bindParam(9, $categories);
        $stmt->bindParam(10, $agent_url);
        $stmt->bindParam(11, $agent_email);
        $stmt->execute();

        $last_insert_id = $dbh->lastInsertId();

            // agentテーブルにメールアドレスとパスワードを挿入する
            $agent_email = $_POST['agent-email']; // エージェントのメールアドレス

            // パスワードのハッシュ化
            $password = password_hash($_POST['agent-email'], PASSWORD_DEFAULT); // メールアドレスを使って適当な方法でハッシュ化

            // SQL文の準備
            $sql = "INSERT INTO agent (mail, password, agent_id) VALUES (?, ?, ?)";

            // プリペアドステートメントを作成
            $stmt = $dbh->prepare($sql);

            // パラメータをバインドしてSQLを実行
            $stmt->bindParam(1, $agent_email);
            $stmt->bindParam(2, $password);
            $stmt->bindParam(3, $last_insert_id);
            $stmt->execute();

        // ステートメントを閉じる
        $stmt->closeCursor();

        // データベース接続を閉じる
        $dbh = null;

        $_SESSION['message'] = "エージェント企業の登録に成功しました。";
        header('Location: http://localhost:8080/Cadmin/index.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['message'] = "エージェント企業の登録に失敗しました。";
        error_log($e->getMessage());
        exit;
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        exit;
    }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
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
                    <div class="side-content choiced"><a href="#">エージェント企業新規登録</a></div>
                    <div class="side-content"><a href="../../Cadmin/auth/newadmin.php">新規管理者登録</a>
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
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !$all_fields_filled) {
                    echo "<div style='color: red; margin-bottom: 10px;'>すべての項目を入力してください。</div>";
                } ?>
                <form action="" class="" method="POST" enctype="multipart/form-data">
                    <table class="table-res-form">
                        <div class="create-list">
                            <tr>
                                <th><label for="site-name" class="create_form-label">サービス名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="site-name" id="site-name" class="form-control" placeholder="サービス名を入力してください" required/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-name" class="create_form-label">企業名</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-name" id="agent-name" class="form-control " placeholder="企業名を入力してください" required/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>

                                <th><label for="agent-logo" class="create_form-label">企業ロゴ</label>

                                </th>
                                <td class="create_td1a"><input type="file" name="agent_logo" id="agent_logo" class="form-control1  " enctype="multipart/form-data" required/>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-overview" class="create_form-label">企業の概要 <br>（50文字以内）</label>
                                </th>
                                <td class="create_td1"><input type="text" name="agent-overview" id="agent-overview" class="form-control " placeholder="企業の概要・説明を入力してください"required/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th><label for="agent-kinds" class="create_form-label">企業種類</label>
                                </th>
                                <td class="create_td2">
                                    <select name="agent-kinds" class="create_select" id="agent-kinds">
                                        <option>未選択</option>
                                        <option>総合型</option>
                                        <option>特化型</option>
                                    </select>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-scale" class="create_form-label" id="agent-scale1">企業規模</label>
                                </th>
                                <td class="create_td2">
                                    <select name="agent-scale" class="create_select" id="agent-scale2">
                                        <option>未選択</option>
                                        <option>大手</option>
                                        <option>中小</option>
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
                                <td class="create_td1" style="display: flex; align-items: end;"><input type="text" name="job-opening" id="job-opening" class="form-control"  style="margin-left: 50px" required/>
                                    <strong>社</strong>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="category" class="create_form-label" id="categoryA">カテゴリ</label>
                                </th>
                                <td class="create_td1">
                                    <div class="form-tag" style="column-count: 4; text-align: left;" id="categoryB">
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
                                    <input type="text" name="agent-url" id="agent-url" class="form-control" placeholder="企業HPのURLを入力してください" required/>
                                </td>
                            </tr>
                        </div>
                        <div class="create-list">
                            <tr>
                                <th>
                                    <label for="agent-email" class="create_form-label">メールアドレス</label>
                                </th>
                                <td class="create_td1"><input type="email" name="agent-email" id="agent-email" class="form-control" placeholder="企業のメールアドレスを入力してください" required/>
                                </td>
                            </tr>
                        </div>
                    </table>
                    <div class="create_sample" id="createSam">
                        <p class="create_sampleP"> サンプル　学生側には以下のように表示されます</p>
                        <div class="create_sample-figure" style="width: 270.667px;">
                            <div class="slider-img">
                                <img src="../../assets/img/aboutCRAFT_logo.png" alt="" width="180px" height="80px">
                            </div>
                            <div class="slider-titles">
                                <p class="slider-title">CRAFT</p>
                                <p class="slider-title-sub">posse</p>
                            </div>
                            <div class="slider-tags">
                                <div class="slider-tag big">
                                    <p class="slider-tagsent">大手</p>
                                </div>
                            </div>
                            <div class="slider-contents">
                                <p>エージェント企業比較サイト</p>
                                <p>地域：全国</p>
                                <p>求人数：1000万</p>
                                <p style="color:blue;">この企業のHPはこちら</p>
                            </div>
                        </div>
                        <div class="create_btn">
                            <button type="submit" id="saveButton">新規登録</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <footer>
        <div class="footer-copyright">
            <small>&copy; POSSE,Inc</small>
        </div>
    </footer>
    <script>
        function validateForm() {
            var siteName = document.getElementById('site-name').value;
            var agentName = document.getElementById('agent-name').value;
            var agentLogo = document.getElementById('agent_logo').value;
            var agentOverview = document.getElementById('agent-overview').value;
            var agentKinds = document.getElementById('agent-kinds').value;
            var region = document.getElementById('region').value;
            var jobOpening = document.getElementById('job-opening').value;
            var agentUrl = document.getElementById('agent-url').value;
            var agentEmail = document.getElementById('agent-email').value;

            // 必須項目の入力チェック
            // if (siteName === '' || agentName === '' || agentLogo === '' || agentOverview === '' || agentKinds === '' || region === '' || jobOpening === '' || agentUrl === '' || agentEmail === '') {
            // alert('すべての項目を入力してください。');
            // return false;
            // }

            // 総合型の場合、企業規模とカテゴリの入力チェックをスキップ
            if (agentKinds === '総合型') {
                return true;
            }

            // 企業規模とカテゴリの選択チェック
            var agentScale = document.getElementById('agent-scale').value;
            var categoryCheckboxes = document.querySelectorAll('input[name="category[]"]');
            var categorySelected = false;
            categoryCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    categorySelected = true;
                }
            });

            if (agentScale === '' || !categorySelected) {
                alert('企業規模とカテゴリを選択してください。');
                return false;
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const agentKindsSelect = document.getElementById('agent-kinds');
            const category1Div = document.getElementById('categoryA'); // 新たに追加されたカテゴリ1の要素
            const category2Div = document.getElementById('categoryB'); // 新たに追加されたカテゴリ2の要素
            const agentScale1Div = document.getElementById('agent-scale1'); // 修正された企業規模1の要素
            const agentScale2Div = document.getElementById('agent-scale2'); // 修正された企業規模2の要素

            if (agentKindsSelect && category1Div && category2Div && agentScale1Div && agentScale2Div) { // 要素がすべて存在することを確認
                agentKindsSelect.addEventListener('change', function() {
                    // if (this.value === '総合型') {
                    //     category1Div.style.visibility = 'hidden'; // カテゴリ1を非表示
                    //     category2Div.style.visibility = 'hidden'; // カテゴリ2を非表示
                    //     agentScale1Div.style.visibility = 'hidden'; // 企業規模1を非表示
                    //     agentScale2Div.style.visibility = 'hidden'; // 企業規模2を非表示
                    // } else if (this.value === '特化型') {
                    //     category1Div.style.visibility = 'visible'; // カテゴリ1を表示
                    //     category2Div.style.visibility = 'visible'; // カテゴリ2を表示
                    //     agentScale1Div.style.visibility = 'visible'; // 企業規模1を表示
                    //     agentScale2Div.style.visibility = 'visible'; // 企業規模2を表示
                    // }

                });
            }
        });


        const submitButton = document.querySelector('.btn.submit')
        const inputDoms = Array.from(document.querySelectorAll('.required'))
        inputDoms.forEach(inputDom => {
            inputDom.addEventListener('input', event => {
            const isFilled = inputDoms.filter(d => d.value).length === inputDoms.length
            submitButton.disabled = !isFilled
            })
        })
    </script>
</body>

</html>