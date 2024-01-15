<?php
session_start();
include('baglanti.php');
$maxFileSize = 1024 * 1024 * 5;
function compress_image($source_url, $destination_url, $quality)
{
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);
    elseif ($info['mime'] == 'image/jpg')
        $image = imagecreatefromjpeg($source_url);

    imagejpeg($image, $destination_url, $quality);

    return $destination_url;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_FILES["dosya"]["size"] > $maxFileSize) {
        echo "Hata: Dosya boyutu 5 MB'den büyük olamaz.";
    } else {

        $imname = $_FILES["dosya"]["tmp_name"];
        $source_photo = $imname;
        $namecreate = "codeconia_" . time();
        $namecreatenumber = rand(1000, 10000);
        $picname = $namecreate . $namecreatenumber;
        $finalname = $picname . ".jpeg";
        $dest_photo = 'dosya/' . $finalname;
        $compressimage = compress_image($source_photo, $dest_photo, 80);
        if ($compressimage != '') {
            $user_id = $_SESSION['user_id'];
            $etiket = mysqli_real_escape_string($conn, $_POST['ekleme']); 
            $query = "INSERT INTO resimler (resim, user_id, etiket) VALUES ('$compressimage', '$user_id', '$etiket')";
            $execute = mysqli_query($conn, $query);

            if ($execute) {
                echo '<div class="alert alert-success" role="alert">
                Yükleme işlemi başarılı bir şekile gerçekleşti.
                </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Yükleme işlemi sırasında bir sorun ile karşılaştıl 
                </div>';
                mysqli_error($conn);
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
    <title>dosyaYukle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        ul {
            list-style-type: none;
            display: flex;
            padding: 0;
        }

        li {
            margin-right: 10px;
        }

        .dosya_yukle form {
            display: flex;
            align-items: center;
        }

        .dosya_yukle label {
            margin-right: 10px;
        }

        .dosya_yukle button {
            margin-left: auto;
        }

        .bar {
            display: flex;
            justify-content: space-between;
            background-color: #a393eb;
            border-radius: 15px;
            padding-left: 25px;
            padding-top: 5px;
            margin: 10px auto;
            width: 800px;
            align-items: center;
        }

        .bar li {
            margin-right: 50px;
        }
    </style>
</head>

<body>
    <nav>

        <a href="index.php"><img class="logo" src="logo.png"></a>
        <div class="search-box">
            <input type="text" placeholder="Ara...">
            <button type="button">Ara</button>
        </div>

        <div class="isim ml-auto">
            <a href="profil.php">
                <h3>
                    <?php
                    echo
                    $_SESSION['username'];
                    ?>
                </h3>
            </a>
        </div>
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="exit.php">Çıkış yap</a>
        </div>
    </nav>
    <div class="bar">
        <ul>
            <li>
                <div class="dosya_yukle">
                    <form action="yukleme.php" method="POST" enctype="multipart/form-data">
            <li>
                <button class="anasayfa"><input type="file" name="dosya" /></button>
            </li>
            <li>
                <label for="ekleme">Etiket giriniz:</label>
                <input type="text" id="ekleme" name="ekleme" >
            </li>
            <li>
                <button class="anasayfa"><input type="submit" value="Yükle"></button>
            </li>
            </form>
    </div>
    </li>
    </ul>
    </div>
</body>
<?php
include('resimler.php');

?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>