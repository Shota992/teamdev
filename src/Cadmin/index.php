<!-- エージェント企業一覧ページ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="./Cadmin.css" />
    <script src="./assets/js/script.js">
    </script>
</head>
<body class="body-c">
    <div class="index-wrapper">
        <div class="side-container">
            <div class="index-side-contents">
            <div class="side-content side-choiced">
                <div class="side-sent side-choiced">エージェント企業一覧</div>
            </div>
            <div class="side-content">
                <div class="side-sent">エージェント企業新規登録
                </div>
            </div>
            <div class="side-content">
                <div class="side-sent">新規管理者登録</div>
            </div>
            <div class="side-content">
                <div class="side-sent">申込み内容一覧</div>
            </div>
            <div class="side-content">
                <div class="side-sent">ログアウト</div>
            </div>
            </div>
        </div>
        <div class="index-main-container">
            <div class="index-main-inner">
                <div class="index-main-head">
                    <div class="index-main-head-container">
                        <div class="index-main-head-sent">エージェント企業一覧</div>
                    </div>
                </div>
                <div class="index-main-search">
                    <div class="index-main-search-contents">
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">サービス名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off">
                        </div>
                        <div class="index-main-search-content">
                            <div class="index-main-search-title">企業名</div>
                            <input class="index-main-search-input" type="text" placeholder="検索" autocomplete="off">
                        </div>
                        <button class="index-main-search-button">検索</button>
                    </div>
                </div>
                <div class="index-main-table">
                    <table  class="index-main-table-conainer">
                        <tr class="index-main-table-head">
                            <td class="index-main-table-content">企業ID</td>
                            <td class="index-main-table-content">サービス名</td>
                            <td class="index-main-table-content">企業名</td>
                            <td class="index-main-table-content">メールアドレス</td>
                        </tr>
                        <tr class="index-main-table-contents index-odd">
                            <td class="index-main-table-content">1001</td>
                            <td class="index-main-table-content">doda</td>
                            <td class="index-main-table-content">パーソナル株式会社</td>
                            <td class="index-main-table-content">aaa@gmail.com</td>
                        </tr>
                        <tr class="index-main-table-contents index-even">
                            <td class="index-main-table-content">1001</td>
                            <td class="index-main-table-content">doda</td>
                            <td class="index-main-table-content">パーソナル株式会社</td>
                            <td class="index-main-table-content">aaa@gmail.com</td>
                        </tr>
                        <tr class="index-main-table-contents index-odd">
                            <td class="index-main-table-content">1001</td>
                            <td class="index-main-table-content">doda</td>
                            <td class="index-main-table-content">パーソナル株式会社</td>
                            <td class="index-main-table-content">aaa@gmail.com</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>