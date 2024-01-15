<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>


<body>

    <div class="container">
        <?php
        include('baglanti.php');

        $query = "SELECT * FROM resimler";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="image" >
            <div class="close"></div>
                <img src="' . $row['resim'] . '" alt="">
                <div class="yorumlar">
                <form action="">
                <input type="text"  placeholder="Düşünceleriniz neler...">
                <button class="anasayfa" name="gonder">Gönder</button>
                </form>
    
            </div>



            </div>
        ';
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        let images = document.querySelectorAll('.image');
        let closes = document.querySelectorAll('.close');
        let body = document.body;

        images.forEach(function(img) {
            img.addEventListener('click', function() {
                img.classList.add('active');
                body.classList.add('blur');
            });
        });
        closes.forEach(function(close) {
            close.addEventListener('click', function() {
                event.stopPropagation();
                images.forEach(function(img) {
                    img.classList.remove('active');
                });
                body.classList.remove('blur');
            });
        });
        });
    </script>




    <?php
    $query = "SELECT * FROM resimler";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $resim_query = "SELECT * FROM resimler WHERE id = " . $row['id'];
        $resim_result = mysqli_query($conn, $resim_query);
        $resim_row = mysqli_fetch_assoc($resim_result);

        $yorum_sorgu = "SELECT * FROM yorumlar WHERE id = " . $resim_row['id'];
        $yorum_sonuc = mysqli_query($conn, $yorum_sorgu);

        echo '<div class="yorumlar-container">';
        while ($yorum_row = mysqli_fetch_assoc($yorum_sonuc)) {
            echo '<div class="yorum">' . $yorum_row['yorum_metni'] . '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
    ?>





    </div>



</body>

</html>