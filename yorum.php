<?php 
include("baglanti.php");
?>

<?php
session_start();

$conn = mysqli_connect($host, $username, $password, $veri_tabani);
mysqli_set_charset($conn, "UTF8");

if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yorum = mysqli_real_escape_string($conn, $_POST["yorum"]); 
    $id = $_SESSION['id']; 

    $query = "INSERT INTO yorumlar (id, yorum) VALUES ('$id', '$yorum')";

    if (mysqli_query($conn, $query)) {
        echo "Yorum başarıyla eklendi.";
    } else {
        echo "Hata: " . mysqli_error($conn);
    }
}

$sorgu = "SELECT * FROM yorumlar";
$sonuc = mysqli_query($conn, $sorgu);

if (mysqli_num_rows($sonuc) > 0) {
    while ($row = mysqli_fetch_assoc($sonuc)) {
        echo "<p>{$row['id']}: {$row['yorum']}</p>";
    }
} else {
    echo "Henüz yorum yapılmamış.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorum Ekle</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <form method="post" action="">
        <label for="yorum">Yorum:</label>
        <textarea name="yorum" rows="4" required></textarea>

        <button type="submit" class="anasayfa">Yorumu Gönder</button>
    </form>
</body>
</html>

