<?php
// dbconnect.phpファイルを読み込む
require_once '../../dbconnect.php';

// POSTリクエストがあるかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 画像を保存するディレクトリが存在しない場合は作成する
    $upload_directory = "../../uploads/";
    if (!file_exists($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    // カテゴリが選択されている場合のみimplode()関数を適用する
    $categories = isset($_POST['category']) ? implode(", ", $_POST['category']) : '';

    // すべての項目が入力されているかどうかをチェックするフラグを初期化
    $all_fields_filled = true;

    // 必須項目が空であるかどうかをチェック
    if (
        empty($site_name) ||
        empty($agent_name) ||
        empty($agent_overview) ||
        empty($agent_kinds) ||
        ($agent_kinds !== "総合型" && empty($agent_scale)) ||
        empty($region) ||
        empty($job_opening) ||
        empty($categories) ||
        empty($agent_url) ||
        empty($agent_email)
    ) {
        $all_fields_filled = false;
    }

    // フォームからのデータを取得
    $site_name = $_POST['site-name'];
    $agent_name = $_POST['agent-name'];
    $agent_logo = $_FILES['agent-logo']['name'];
    $agent_logo_tmp = $_FILES['agent-logo']['tmp_name'];
    $agent_overview = $_POST['agent-overview'];
    $agent_kinds = isset($_POST['agent-kinds']) ? $_POST['agent-kinds'] : null;
    $agent_scale = isset($_POST['agent-scale']) ? $_POST['agent-scale'] : null;
    $region = $_POST['region'];
    $job_opening = $_POST['job-opening'];
    // カテゴリが選択されている場合のみimplode()関数を適用する
    $categories = isset($_POST['category']) ? implode(", ", $_POST['category']) : '';
    $agent_url = $_POST['agent-url'];
    $agent_email = $_POST['agent-email'];


    // 必須項目が空であるかどうかをチェック
    if (
        empty($site_name) ||
        empty($agent_name) ||
        empty($agent_logo) ||
        empty($agent_overview) ||
        empty($agent_kinds) ||
        ($agent_kinds !== "総合型" && empty($agent_scale)) ||
        empty($region) ||
        empty($job_opening) ||
        empty($categories) ||
        empty($agent_url) ||
        empty($agent_email)
    ) {
        // すべての項目が入力されていない場合はエラーメッセージを表示して処理を中断
        echo "<div style='color: red; margin-bottom: 10px;'>すべての項目を入力してください。</div>";
        exit; // 処理を中断する
    }

    // 画像をサーバに保存
    $target_file = $upload_directory . basename($agent_logo);
    move_uploaded_file($agent_logo_tmp, $target_file);

    // 総合型の場合、企業規模とカテゴリを空文字列に設定
    if ($agent_kinds == "総合型") {
        $agent_scale = '';
        $categories = '';
    } else {
        // カテゴリが選択されている場合のみimplode()関数を適用する
        $categories = isset($_POST['category']) ? implode(", ", $_POST['category']) : '';
    }

    // 総合型の場合、企業規模とカテゴリをnullに設定
    // if ($agent_kinds == "総合型") {
    // $agent_scale = null;
    // $categories = null;
    // }


    // SQL文の準備
    $sql = "INSERT INTO info (site_name, agent_name, logo, explanation, type, size, area, amounts, category, url, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // プリペアドステートメントを作成
    $stmt = $dbh->prepare($sql);

    // パラメータをバインドしてSQLを実行
    $stmt->bindParam(1, $site_name);
    $stmt->bindParam(2, $agent_name);
    $stmt->bindParam(3, $agent_logo);
    $stmt->bindParam(4, $agent_overview);
    $stmt->bindParam(5, $agent_kinds);
    $stmt->bindParam(6, $agent_scale);
    $stmt->bindParam(7, $region);
    $stmt->bindParam(8, $job_opening);
    $stmt->bindParam(9, $categories);
    $stmt->bindParam(10, $agent_url);
    $stmt->bindParam(11, $agent_email);
    $stmt->execute();

    // ステートメントを閉じる
    $stmt->closeCursor();

    // データベース接続を閉じる
    $dbh = null;

    // リダイレクト
    header("Location: ../../../../Cadmin/index.php");
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
                                    <select name="agent-kinds" class="create_select" id="agent-kinds">
                                        <option value="">選択してください</option>
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
                                    <label for="category" class="create_form-label" id="category1">カテゴリ</label>
                                </th>
                                <td class="create_td1">
                                    <div class="form-tag" style="column-count: 4; text-align: left;" id="category2">
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
                        </div>
                        <button type="submit" class="create_btn">新規登録</button>
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
            var agentLogo = document.getElementById('agent-logo').value;
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
            const category1Div = document.getElementById('category1'); // 新たに追加されたカテゴリ1の要素
            const category2Div = document.getElementById('category2'); // 新たに追加されたカテゴリ2の要素
            const agentScale1Div = document.getElementById('agent-scale1'); // 修正された企業規模1の要素
            const agentScale2Div = document.getElementById('agent-scale2'); // 修正された企業規模2の要素

            if (agentKindsSelect && category1Div && category2Div && agentScale1Div && agentScale2Div) { // 要素がすべて存在することを確認
                agentKindsSelect.addEventListener('change', function() {
                    if (this.value === '総合型') {
                        category1Div.style.visibility = 'hidden'; // カテゴリ1を非表示
                        category2Div.style.visibility = 'hidden'; // カテゴリ2を非表示
                        agentScale1Div.style.visibility = 'hidden'; // 企業規模1を非表示
                        agentScale2Div.style.visibility = 'hidden'; // 企業規模2を非表示
                    } else if (this.value === '特化型') {
                        category1Div.style.visibility = 'visible'; // カテゴリ1を表示
                        category2Div.style.visibility = 'visible'; // カテゴリ2を表示
                        agentScale1Div.style.visibility = 'visible'; // 企業規模1を表示
                        agentScale2Div.style.visibility = 'visible'; // 企業規模2を表示
                    }

                });
            }
        });
    </script>
</body>

</html>