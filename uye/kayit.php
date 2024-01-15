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
    <link rel="stylesheet" type="text/css" href="style.css">


</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2 class="mb-6">Kayıt Ol</h2>
                <form action="kayit.php" method="POST">
                    <div>
                        <label for="firstName">Kullanıcı Adı</label>
                        <input type="text" id="firstName" name="kullanici_adi" placeholder="Kullanıcı adınızı giriniz..." required>
                    </div>
                    <div class="">
                        <label for="email">E-posta Adresi:</label>
                        <input type="email" id="email" name="email" placeholder="E-posta adresinizi" required><br>
                    </div>
                    <div>
                        <label for="password">Şifre</label>
                        <input type="password" id="password" name="paralo" placeholder="Şifrenizi giriniz..." required>
                    </div>
                    <button type="submit" class="button" name="kaydet">Kayıt Ol</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>