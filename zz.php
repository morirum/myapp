<?php
include 'baglanti.php';

$imageId = $_POST['image_id'];
$commentText = $_POST['comment_text'];

$sql = "INSERT INTO yorumlar (image_id, yorum) VALUES ('$imageId', '$commentText')";

if ($conn->query($sql) === TRUE) {
    echo "Yorum başarıyla eklendi";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
