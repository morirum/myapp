<?php
include('baglanti.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>morirum</title>

    <link rel="stylesheet" type="text/css" href="style.css">



</head>

<body>

    <nav>

        <a href="index.php"><img class="logo" src="logo.png"></a>
        <form method="post" action="">
            <div class="search-box">
                <input type="text" name="arama" placeholder="Ara...">
                <button type="submit" name="ara">Ara</button>
                <?php
                if (isset($_POST['arama'])) {
                    $arama = $_POST['arama'];

                    $sqlKullanicilar = "SELECT * FROM kullanicilar WHERE kullanici_adi LIKE '%$arama%'";
                    $sqlResimler = "SELECT * FROM resimler WHERE etiket LIKE '%$arama%'";

                    $resultKullanicilar = $conn->query($sqlKullanicilar);
                    $resultResimler = $conn->query($sqlResimler);

                    if ($resultKullanicilar->num_rows > 0) {
                        $row = $resultKullanicilar->fetch_assoc();
                        $redirect_user_id = $row["id"];
                        $redirect_username = $row["kullanici_adi"];
                        $_SESSION['username'] = $redirect_username;
                        header("Location: profil.php?user_id=$redirect_user_id&username=$redirect_username");
                        exit();
                    } elseif ($resultResimler->num_rows > 0) {
                        while ($rowResim = $resultResimler->fetch_assoc()) {
                            $resimId = $rowResim["id"];
                            $resimEtiket = $rowResim["etiket"];
                            echo '<img src="../dosya/' . $resimId . '.jpg" alt="' . $resimEtiket . '">';
                        }
                    } else {
                        $sqlTumResimler = "SELECT * FROM resimler";
                        $resultTumResimler = $conn->query($sqlTumResimler);

                        if ($resultTumResimler->num_rows > 0) {
                            while ($rowTumResim = $resultTumResimler->fetch_assoc()) {
                                $resimId = $rowTumResim["id"];
                                $resimEtiket = $rowTumResim["etiket"];
                                echo '<img src="../dosya/' . $resimId . '.jpg" alt="' . $resimEtiket . '">';
                            }
                        } else {
                            echo "Eşleşen kayıt bulunamadı.";
                        }
                    }
                }
                ?>
            </div>
        </form>

        <div class="user-actions ml-auto">
            <a class="nav-item nav-link" href="giris_yap.php" target="self">Giriş Yap</a>
            <a class="nav-item nav-link" href="kayit.php" target="self">Kayıt Ol</a>
        </div>
    </nav>


    <div class="container">

        <?php
        include('resimler.php');
        ?>


    </div>
    <script>
        let images = document.querySelectorAll('.image');

        images.forEach(function(img) {
            img.addEventListener('click', function() {
                img.classList.toggle('active');
                body.classList.toggle('blur');
            });
        });
    </script>
</body>

</html>