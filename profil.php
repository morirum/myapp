<?php
ob_start();
?>
<?php
session_start();
?>
<?php
include("baglanti.php");
$session_id= $_SESSION['user_id'];
$id = isset($_GET["user_id"]) ? intval($_GET["user_id"]) : 0;
$id = mysqli_real_escape_string($conn, $id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profilim</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;

        }

        .kutu {
            overflow: hidden;
            width: 100%;
        }


        ul {
            list-style: none;
        }

        ul li {
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;

        }

        .sol_taraf {
            flex: 4;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
            float: left;
        }

        .sag_taraf {
            flex: 6;
            width: 60%;
            flex-direction: column;
            align-items: center;
            float: right;
        }

        .gonderiler-baslik {
            text-align: center;
            margin-bottom: 20px;


        }

        .uyeAdi {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 100%;
        }

        .uyeAdi h1 {
            margin: 0;
            padding: 0;
        }

        .resim-container {

            max-width: 100%;
            min-height: 400px;
            overflow: hidden;
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;

        }


        .resim-container .imgbox {
            width: 30%;
            height: 400px;
            margin-top: 10px;

        }

        .resim-container img {
            width: 100%;
            height: 400px;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            object-fit: cover;

        }

        .resim-container:hover img {
            transform: scale(1.1);
        }


        .takip {
            display: flex;
            justify-content: center;


        }
    </style>
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
            $aranan = $_POST['arama'];

            $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi LIKE '%$aranan%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $redirect_user_id = $row["id"];
                $redirect_username = $row["kullanici_adi"];
                $_SESSION['username'] = $redirect_username;
                header("Location: profil.php?user_id=$redirect_user_id&username=$redirect_username");
                exit();
            } else {
                echo "Eşleşen kayıt bulunamadı.";
            }
        }
        ?>


        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="exit.php">Çıkış yap</a>
        </div>
    </nav>



    <div class="kutu">
        <div class="sol_taraf">
            <div class="uyeAdi">
                <h1>
                    <?php
                    echo
                    $_SESSION["username"];
                    echo "\n" . $id;

                    ?>
                </h1>

            </div>
            <?php
            $aranan = isset($_POST['arama']) ? $_POST['arama'] : '';
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            ?>


            <div class="uyeBilgileri">
                <ul>
                    <li>Gönderiler</li>
                    <?php
                    $sorgu = "SELECT COUNT(*) as post_count FROM resimler WHERE user_id = '$id'";
                    $sonuc = mysqli_query($conn, $sorgu);
                    $row = mysqli_fetch_assoc($sonuc);
                    $gonderi_sayisi = $row['post_count'];

                    echo $gonderi_sayisi;

                    ?>

                    <li>Takip Edilen</li>
                    <?php
                    $takip_sorgu = "SELECT COUNT(*) as following_count FROM follow WHERE takip = '$id'";
                    $takip_sonuc = mysqli_query($conn, $takip_sorgu);
                    $takip_row = mysqli_fetch_assoc($takip_sonuc);
                    $takip_sayisi = $takip_row['following_count'];

                    echo $takip_sayisi;

                    ?>

                    <li>Takipçiler</li>
                    <?php
                    $takip_sorgu = "SELECT COUNT(*) as following_count FROM follow WHERE takipci = '$id'";
                    $takip_sonuc = mysqli_query($conn, $takip_sorgu);
                    $takip_row = mysqli_fetch_assoc($takip_sonuc);
                    $takipci_sayisi = $takip_row['following_count'];

                    echo $takipci_sayisi;

                    ?>
                </ul>
                <div class="takip">
                    <form method="post" action="" class="yanyana">
                        <button type="submit" class="anasayfa" name="takip_et">Takip Et</button>
                        <input type="hidden" name="follow_id" value="<?php echo $_GET["user_id"] ?>">
                        <button type="submit" class="anasayfa" name="takip_birak">Takibi Bırak</button>

                    </form>

                </div>

                <?php
                if (isset($_SERVER["REQUEST_METHOD"]) == "POST" && isset($_POST['takip_et'])) {
                    $follow_id = @$_POST["follow_id"];

                    $takip_sorgu = "SELECT * FROM follow WHERE takip='$follow_id' AND takipci ='$session_id '";

                    $result = $conn->query($takip_sorgu);
                    if ($result->num_rows > 0) {
                        echo 'Zaten takiptesin';
                    } else {
                        
                        $follow = "INSERT INTO follow (takip,takipci) VALUES ('$follow_id','$session_id')";
                        mysqli_query($conn, $follow);
                    }

                    
                }
                if (isset($_POST['takip_birak'])) {
                    $follow_id = @$_POST["follow_id"];

                        $takipci = "DELETE FROM follow WHERE takip='$follow_id' AND takipci ='$session_id' ";
                        mysqli_query($conn, $takipci);

                    }
                ?>





            </div>

        </div>

        <div class="sag_taraf">
            <div class="gonderiler-baslik">

                <div class="gonderiler-baslik">
                    <h1>Gönderileriniz</h1>

                    <div class="resim-container">
                        <?php

                        if (isset($_POST['takip_et'])) {
                            echo '<div class="resim-container">';
                            $resim_sorgu = "SELECT * FROM resimler WHERE user_id = $id";
                            $resim_sonuc = mysqli_query($conn, $resim_sorgu);

                            while ($resim_row = mysqli_fetch_assoc($resim_sonuc)) {
                                echo '
                                    <div class="imgbox">
                                        <img src="' . $resim_row['resim'] . '" alt="Kullanıcı Resmi">
                                    </div>
                                ';
                            }
                            echo '</div>';
                        }
                        ?>

                    </div>


                </div>



            </div>

        </div>


    </div>
    </div>

    <?php
    ob_end_flush();

    ?>
</body>

</html>