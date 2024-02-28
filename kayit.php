<?php
include("baglanti.php");

$username_err = $email_err = $parola_err = $parolatkr_err = "";

if (isset($_POST["kaydet"])) {
    if (empty($_POST["kullaniciadi"])) {
        $username_err = "Kullanıcı adı boş geçilemez.";
    } else {
        $username = $_POST["kullaniciadi"];
    }

    if (empty($_POST["email"])) {
        $email_err = "Email alanı boş geçilemez.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçersiz email formatı.";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["parola"])) {
        $parola_err = "Parola boş geçilemez.";
    } else {
        $parola = password_hash($_POST["parola"], PASSWORD_DEFAULT);
    }

    if (empty($_POST["parolatkr"])) {
        $parolatkr_err = "Parola tekrar kısmı boş geçilemez.";
    } elseif ($_POST["parola"] != $_POST["parolatkr"]) {
        $parolatkr_err = "Parolalar eşleşmiyor";
    } else {
        $parolatkr = $_POST["parolatkr"];
    }

    if (isset($username) && isset($email) && isset($parola)) {
        $query = $db->prepare("INSERT INTO kullanicilar (kullanici_adi, email, parola) VALUES (:username, :email, :parola)");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':parola', $parola, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<div class="alert alert-success" role="alert">Kayıt başarıyla tamamlandı.</div>';
            echo '<script type="text/javascript">
                setTimeout(function () {
                    window.location.href = "login.php";
                }, 1000); 
            </script>';
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Kayıt sırasında bir hata oluştu.</div>';
        }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
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
        .card {
            width: 300px;
        }
    </style>
      
    </style>        
      
    <title>Kayıt</title>
  </head>
  <body>
    
    
  
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayıt Ol</title>

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
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card {
            max-width: 300px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Kayıt Ol</h2>
    <form action="kayit.php" method="POST">
        <div class="mb-3">
            <label for="kullaniciadi" class="form-label">İsim</label>
            <input type="text" class="form-control <?php if (!empty($username_err)) { echo "is-invalid"; } ?>" id="kullaniciadi" name="kullaniciadi">
            <div class="invalid-feedback"><?php echo $username_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Eposta Adresi</label>
            <input type="text" class="form-control <?php if (!empty($email_err)) { echo "is-invalid"; } ?>" id="email" name="email">
            <div class="invalid-feedback"><?php echo $email_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="parola" class="form-label">Şifre</label>
            <input type="password" class="form-control <?php if (!empty($parola_err)) { echo "is-invalid"; } ?>" id="parola" name="parola">
            <div class="invalid-feedback"><?php echo $parola_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="parolatkr" class="form-label">Şifre Tekrar</label>
            <input type="password" class="form-control <?php if (!empty($parolatkr_err)) { echo "is-invalid"; } ?>" id="parolatkr" name="parolatkr">
            <div class="invalid-feedback"><?php echo $parolatkr_err; ?></div>
        </div>
        <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

