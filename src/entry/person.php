<!-- 個人情報入力ページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>個人情報入力</title>
</head>
<body>
    <?php 
    // include __DIR__ . '../includes/header2.php'; 
    ?>
    <main>
        <div class="container">
            <div class="person-nav">
                <h1>Step4 個人情報の入力</h1>
            </div>
            <form class="person-form" method="POST">
                <div>
                    <label for="name" class="form-label">お名前</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div></div>
                <button></button>
            </form>
        </div>
    </main>
    <?php 
    // include __DIR__ . '../includes/footer1.php'; 
    ?>
</body>
</html>