<?php
include("baglanti.php");

$username_err = $parola_err = "";

if (isset($_POST["giris"])) {
    if (empty($_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı boş geçilemez.";
    } else {
        $username = $_POST["kullaniciadi"];
    }

    if (empty($_POST["parola"])) {
        $parola_err = "Parola boş geçilemez.";
    } else {
        $parola = $_POST["parola"];
    }

    if (isset($username) && isset($parola)) {
        $query = $db->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = :username");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $ilgilikayit = $query->fetch(PDO::FETCH_ASSOC);

        if ($ilgilikayit) {
            $hashlisifre = $ilgilikayit["parola"];

            if (password_verify($parola, $hashlisifre)) {
                session_start();
                $_SESSION["kullanici_adi"] = $ilgilikayit["kullanici_adi"];
                $_SESSION["email"] = $ilgilikayit["email"];
                header("location: profile.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">Kullanıcı Adı veya Parola Yanlış</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Kullanıcı Bulunamadı</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Üye Giriş</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('ssa.jpg');
            background-size: cover;
            background-position: center;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Giriş</h2>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="kullaniciadi" class="form-label">İsim</label>
            <input type="text" class="form-control <?php if (!empty($username_err)) { echo "is-invalid"; } ?>" id="kullaniciadi" name="kullaniciadi">
            <div class="invalid-feedback"><?php echo $username_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="parola" class="form-label">Parola</label>
            <input type="password" class="form-control <?php if (!empty($parola_err)) { echo "is-invalid"; } ?>" id="parola" name="parola">
            <div class="invalid-feedback"><?php echo $parola_err; ?></div>
        </div>
        <button type="submit" name="giris" class="btn btn-primary">Giriş Yap</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
