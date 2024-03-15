<!-- 申込内容一覧ページ -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>content</title>
    <link rel="stylesheet" href="./Cadmin.css" />
    <script src="./assets/js/script.js" defer></script>
</head>
<body class="body-c">
    <div class="index-wrapper">
        <div class="side-container">
            <div class="index-side-contents">
            <div class="side-content ">
                <div class="side-sent ">エージェント企業一覧</div>
            </div>
            <div class="side-content">
                <div class="side-sent">エージェント企業新規登録
                </div>
            </div>
            <div class="side-content">
                <div class="side-sent">新規管理者登録</div>
            </div>
            <div class="side-content side-choiced">
                <div class="side-sent side-choiced">申込み内容一覧</div>
            </div>
            <div class="side-content">
                <div class="side-sent">ログアウト</div>
            </div>
            </div>
        </div>
        <div class="content-main-container">
            <div class="content-main-inner">
                <div class="content-main-head">
                    <div class="content-main-head-container">
                        <div class="content-main-head-sent">申し込み内容一覧</div>
                    </div>
                </div>
                <div class="content-main-search">
                    <div class="content-main-search-contents">
                        <div class="content-main-search-radios">
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio1" name="color" value="red">
                                <label>申込み日時順</label>
                            </div>
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio2" name="color" value="red">
                                <label>サイト名の五十音順</label>
                            </div>
                            <div class="content-main-search-radio">
                                <input type="radio" id="radio3" name="color" value="red">
                                <label>学生氏名の五十音順</label>
                            </div>
                        </div>
                        <div class="content-main-search-checks">
                            <div class="content-main-search-check">
                                <input type="checkbox" id="check1" name="color" value="red">
                                <label>タスク完了済み</label>
                            </div>
                            <div class="content-main-search-check">
                                <input type="checkbox" id="check2" name="color" value="red">
                                <label>タスク未完了</label>
                            </div>
                        </div>
                        <div class="content-main-search-content">
                            <div class="content-main-search-title">サイト名検索</div>
                            <input class="content-main-search-input" type="text" autocomplete="off">
                        </div>
                    </div>
                    <button class="content-main-search-button">検索</button>
                </div>
                <div class="content-main-table">
                    <table  class="content-main-table-container">
                        <tr class="content-main-table-head">
                            <td class="content-main-table-content">申込み日時</td>
                            <td class="content-main-table-content">企業ID</td>
                            <td class="content-main-table-content">サイト名</td>
                            <td class="content-main-table-content">学生氏名</td>
                            <td class="content-main-table-content">タスク完了</td>
                        </tr>
                        <tr class="index-main-table-contents content-odd">
                            <td class="content-main-table-content">24/04/01</td>
                            <td class="content-main-table-content">1001</td>
                            <td class="content-main-table-content">doda</td>
                            <td class="content-main-table-content">倉　富戸</td>
                            <td class="content-main-table-content">
                                <div class="content-main-search-check">
                                    <input type="checkbox" name="color" value="red">
                                </div>
                            </td>
                        </tr>
                        <tr class="index-main-table-contents content-even">
                            <td class="content-main-table-content">24/04/01</td>
                            <td class="content-main-table-content">1001</td>
                            <td class="content-main-table-content">doda</td>
                            <td class="content-main-table-content">倉　富戸</td>
                            <td class="content-main-table-content">
                                <div class="content-main-search-check">
                                    <input type="checkbox" name="color" value="red">
                                </div>
                            </td>
                        </tr>
                        <tr class="index-main-table-contents content-odd">
                            <td class="content-main-table-content">24/04/01</td>
                            <td class="content-main-table-content">1001</td>
                            <td class="content-main-table-content">doda</td>
                            <td class="content-main-table-content">倉　富戸</td>
                            <td class="content-main-table-content">
                                <div class="content-main-search-check">
                                    <input type="checkbox" name="color" value="red">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>