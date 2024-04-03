<!-- エージェント企業編集ページ -->

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