<?php
include('baglanti.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    

    if (isset($_POST['submit'])) {
        $user = "SELECT * FROM kullanicilar WHERE kullanici_adi=?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $user)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['kullanici_adi'] && $password == $row['paralo']) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $row['id'];
                    header('Location: uyeler.php');

                    exit();
                } else {
                    echo 'Geçersiz kullanıcı adı veya şifre.';
                }
            }
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Ekranı</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .logo {

            text-align: center;
            justify-content: center;
            display: flex;
            width: 100%;
            margin-bottom: 15px;

        }
    </style>

</head>

<body>

    <div class="logo">
        <img src="logo.png" alt="">
    </div>

    <div class="login-container">
        <h2>Giriş Yap</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="yanyana">
                <button class="anasayfa" type="submit" name="submit"> Giriş</button>
                <button class="anasayfa"> <a href="index.php" name="index">Ana Sayfa</a></button>
            </div>

        </form>

    </div>



</body>

</html>