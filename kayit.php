<?php

include("baglanti.php");
if (isset($_POST["kaydet"])) {
    $name = $_POST["kullanici_adi"];
    $email = $_POST["email"];
    $password = $_POST["paralo"];
    $ekle = "INSERT INTO kullanicilar (kullanici_adi, email, paralo) VALUES ('$name','$email','$password')";
    $calistirekle = mysqli_query($conn, $ekle);
    if ($calistirekle) {
        echo '<div class="alert alert-success" role="alert">
        Kayıt işlemi başarılı bir şekile gerçekleşti.
      </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Kayıt işlemi sırasında bir sorun ile karşılaştıl 
      </div>';
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="still.css">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="logo">
        <img src="logo.png" alt="">
    </div>


    <div class="login-container">


        <div>

            <h2>Kayıt Ekranı</h2><br>
            <form method="post" action="">
                <div class="form-group">
                    <label for="firstName">Kullanıcı Adı:</label>
                    <input type="text" id="username" name="kullanici_adi" placeholder="Kullanıcı Adını Giriniz..." required>
                </div>
                <div class="form-group">
                    <label for="password">Şifre:</label>
                    <input type="password" id="password" name="paralo" placeholder="Şifrenizi Giriniz..." required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail Adresiniz:</label>
                    <input type="email" id="email" name="email" placeholder="E-mail Adresinizi Giriniz..." required>
                </div>

                <div class="yanyana">
                    <button type="submit" name="kaydet" class="anasayfa">Kayıt Ol</button>
                    <button><a href="index.php" type="text"name="index" class="anasayfa">Ana Sayfa</a></button>
                </div>


            </form>

        </div>
    </div>

</body>

</html>