<?php  
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .profile-container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .user-info {
            width: 40%;
        }

        .user-info h1 {
            margin-bottom: 10px;
        }

        .user-images {
            width: 50%;
        }

        .user-images h2 {
            margin-bottom: 10px;
        }

        .user-images img {
            width: 100%;
            margin-bottom: 10px;
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
            <h3>
                <?php
                echo
                $_SESSION['username'];
                ?>
            </h3>
        </div>
        <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link" href="exit.php">Çıkış yap</a>
        </div>
    </nav>






    <?php
    // Kullanıcı bilgilerini alalım (örnek amaçlı)
    $userInfo = array(
        'username' => 'kullanici_adiniz',
        'postCount' => 10,
        'followers' => 100,
        'following' => 50
    );

    // Kullanıcının gönderdiği resimleri alalım (örnek amaçlı)
    $userImages = array(
        'image1.jpg',
        'image2.jpg',
        'image3.jpg'
    );
    ?>

    <div class="profile-container">
        <div class="user-info">
            <h1><?php echo $userInfo['username']; ?></h1>
            <p>Post Count: <?php echo $userInfo['postCount']; ?></p>
            <p>Followers: <?php echo $userInfo['followers']; ?></p>
            <p>Following: <?php echo $userInfo['following']; ?></p>
        </div>

        <div class="user-images">
            <h2>Uploaded Images</h2>
            <?php foreach ($userImages as $image) : ?>
                <img src="<?php echo $image; ?>" alt="User Image">
            <?php endforeach; ?>
        </div>
    </div>







</body>

</html>