<?php
ob_start();
?>
<?php
session_start();
include('baglanti.php');
$username = $_SESSION['username'];
?>

<?php
$id = @$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uyeler</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <nav>

        <a href="index.php"><img class="logo" src="logo.png"></a>

        <div class="search-box">
            <form method="post" action="">
                <input type="text" name="arama" placeholder="Ara...">
                <button type="submit" class="anasayfa">Ara</button>
            </form>
        </div>

        <div class="search-box">
            <a href="yukleme.php"><button>Resim Yükle</button></a>
        </div>
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
        <div class="isim ml-auto">
            <a href="profil.php?user_id=<?php echo $id; ?>">
                <h3>
                    <?php
                    echo $username;
                    ?>
                </h3>
            </a>
        </div>
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="exit.php">Çıkış yap</a>
        </div>
    </nav>
    <?php
    include('resimler.php');
    ?>
    <div class="container">
        <?php
        include('baglanti.php');
        ?>



        <?php
        ob_end_flush();
        ?>

</body>

</html>