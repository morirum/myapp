<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>not_follower</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #container {
            display: flex;
            height: 100vh;
        }

        #sidebar {
            width: 40%;
            background-color: #f1f1f1;
            padding: 20px;
        }

        #content {
            width: 60%;
            padding: 20px;
        }

        #header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        #user-info {
            margin-bottom: 20px;
        }

        #follow-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        #error-message {
            color: red;
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
        <div class="search-box">
            <a href="yukleme.php"><button>Resim Yükle</button></a>

        </div>


        <div class="isim ml-auto">
            <a href="profil.php?user_id=<?php echo $id; ?>">
                <h3>
                    <?php
                    echo
                    $username;
                    ?>
                </h3>
            </a>

        </div>
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="exit.php">Çıkış yap</a>
        </div>
    </nav>




    <div id="container">
        <div id="sidebar">
            <?php if (isset($error_message)) : ?>
                <div id="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php else : ?>
                <div id="user-info">
                    <div><?php echo $username; ?></div>
                    <div>Takipçiler: <?php echo implode(", ", $followers); ?></div>
                    <div>Takip Edilenler: <?php echo implode(", ", $following); ?></div>
                    <div>Gönderi Sayısı: <?php echo $postCount; ?></div>
                </div>
                <div id="follow-button">
                    Takip Et
                </div>
            <?php endif; ?>
        </div>


        <div class="gonderi">Gönderiler</div>
        <?php if (isset($error_message)) : ?>
            <div class="uyari">
                Kullanıcıyı takip etmiyorsunuz ve gönderilerini göremiyorsunuz :/
            </div>
        <?php endif; ?>

    </div>




</body>

</html>