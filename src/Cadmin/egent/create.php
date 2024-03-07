<!-- 新規エージェント企業登録ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>エージェント企業新規登録画面</title>
</head>

<body>
    <header>
        <a href="" class="header-logo" target="_blank" rel="noopener noreferrer">
            <img src="" alt="CRAFT">
        </a>
        <img src="" alt="boozer">
    </header>
    <main>
        <div>
            <h1>エージェント企業新規登録</h1>
        </div>
        <div class="container">
            <form action="" class="" method="POST">
                <div>
                    <label for="agent-name" class="form-label">企業名</label>
                    <input type="text" name="agent-name" id="agent-name" class="form-control" />
                </div>
                <div>
                    <label for="agent-logo" class="form-label">企業ロゴ</label>
                    <input type="text" name="agent-logo" id="agent-logo" class="form-control" />
                    <button type="submit">参照</button>
                </div>
                <div>
                    <label for="agent-overview" class="form-label">企業の概要（50文字以内）</label>
                    <input type="text" name="agent-overview" id="agent-overview" class="form-control" />
                </div>
                <div>
                    <label for="agent-kinds" class="form-label">企業種類</label>
                    <select name="agent-kinds">
                        <option>総合型</option>
                        <option>特化型</option>
                    </select>
                </div>
                <div>
                    <label for="agent-scale" class="form-label">企業規模</label>
                    <select name="agent-scale">
                        <option>大企業</option>
                        <option>中・小企業</option>
                    </select>
                </div>
                <div>
                    <label for="region" class="form-label">地域</label>
                    <select name="region">
                        <option>東京都</option>
                        <option>全国</option>
                        <option>地方</option>
                    </select>
                </div>
                <div>
                    <label for="job-opening" class="form-label">求人数</label>
                    <input type="text" name="job-opening" id="job-opening" class="form-control" />
                    <strong>名</strong>
                </div>
                <div>
                    <label for="category" class="form-label">カテゴリ</label>
                    <!-- ボタンデザイン変更する！！ -->
                    
                </div>
                <div>
                    <label for="agent-url" class="form-label">企業HPのURL</label>
                    <input type="text" name="agent-url" id="agent-url" class="form-control" />
                </div>
                <div>
                    <label for="agent-email" class="form-label">メールアドレス</label>
                    <input type="text" name="agent-email" id="agent-email" class="form-control" />
                </div>
                <button type="submit">保存</button>
            </form>
            <div>
                <p>サンプル　学生側には以下のように表示されます</p>
                <div></div>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-copyright">
            <small>&copy; POSSE,Inc</small>
        </div>
    </footer>
    
</body>

</html>