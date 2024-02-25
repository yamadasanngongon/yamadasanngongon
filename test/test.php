<?php
// フォームが送信された場合の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力されたユーザー名とパスワードを取得
    $username = $_POST["username"];
    $password = $_POST["password"];

    // テキストファイルからユーザー情報を読み取る
    $users = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // ユーザー情報を検証
    foreach ($users as $user) {
        list($storedUsername, $storedPassword) = explode(":", $user);
        if ($username === $storedUsername && $password === $storedPassword) {
            // ログイン成功
            echo "<h2>" . $username . "さん、ようこそ！</h2>";
            // ここで適切なリダイレクトやセッションの設定を行うことができます
            exit;
        }
    }

    // ログイン失敗
    echo "ユーザー名またはパスワードが間違っています。";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ログインフォーム</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* モバイル用スタイル */
        @media (max-width: 480px) {
            form {
                padding: 10px;
            }

            input[type="text"],
            input[type="password"] {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>ログインフォーム</h1>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="username">ユーザー名:</label>
        <input type="text" name="username" required><br>
        <label for="password">パスワード:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="ログイン">
    </form>
</body>
</html>