<?php
session_start();
include("baglanti.php");
if(isset($_POST['add_todo'])){
    $icerik = filter_var($_POST['todolar'], FILTER_SANITIZE_STRING);
    $kullanici_adi = $_SESSION['kullanici_adi'];
    $query = $db->prepare("INSERT INTO todolar (kullanici_adi, icerik) VALUES (:kullanici, :icerik)");
    $todos = $db->query("SELECT * FROM todolar WHERE kullanici_adi='$kullanici_adi' ORDER BY tarih ASC")->fetchAll(PDO::FETCH_ASSOC);
    $query->bindParam(':kullanici', $kullanici_adi, PDO::PARAM_STR);
    $query->bindParam(':icerik', $icerik, PDO::PARAM_STR);
   
    if ($query->execute()) {
        echo "Yeni görev başarıyla eklendi.";
    } else {
        echo "Görev eklenirken bir hata oluştu.";
    }

    
    }
    if(isset($_GET['remove_todo'])){
        $remove_todo = $_GET['remove_todo']; 
        $kullanici_adi = $_SESSION['kullanici_adi'];
        $query = $db->prepare("DELETE FROM todolar WHERE id = :remove_todo AND kullanici_adi = :kullanici_adi");
        $query->bindParam(':remove_todo', $remove_todo, PDO::PARAM_INT);
        $query->bindParam(':kullanici_adi', $kullanici_adi, PDO::PARAM_STR);
        $query->execute();
        
    }

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('ssa.jpg');
            background-size: cover;
            background-position: center;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #483d8b;
        }

        input[type="text"] {
            border: 1px solid #483d8b;
            padding: 5px;
            width: 100%;
        }

    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center" style="color: #483d8b; font-family: 'Arial', sans-serif;">Giriş Başarılı Hoşgeldiniz <?php echo $_SESSION['kullanici_adi'] ?></h1>

    <form method="post" class="todo_form">
        <font size="6" color="Black"> TO DO LİST </font>
        <div class="todo_div">
            <input type="text" class="form-control mb-3" placeholder="Yeni Görev Ekle" name="todolar">
            <input type="text" class="form-control mt-2" placeholder="Görev Filtresi" onkeyup="filterTodos()">
            <button type="submit" name="add_todo" class="btn btn-dark mt-3">Ekle</button>
            
            <form method="post" class="todo_form">
    <button type="submit" name="logout" class="btn btn-secondary mt-3">Çıkış</button>
</form>

        </div>
    </form>

    <div class="todo_container">
        <table class="table mt-4">
            <thead>
            <tr>
                <th scope="col">LİSTE</th>
                <th scope="col">DÜZENLE</th>
                <th scope="col">SİL</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $kullanici_adi = $_SESSION['kullanici_adi'];
            $todos = $db->query("SELECT * FROM todolar WHERE kullanici_adi='$kullanici_adi' ")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($todos as $todo) {
                echo "<tr>";
                echo "<td>" . $todo["icerik"] . "</td>";
                echo "<td><button onclick='editTodo(" . $todo["id"] . ")' class='btn btn-outline-warning'>DÜZENLE</button></td>";
                echo "<td><a href='?remove_todo=" . $todo["id"] . "' class='btn btn-outline-danger'>SİL</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  
    function filterTodos() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.querySelector(".form-control.mt-2");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        var display = "none";
        for (var j = 0; j < tr[i].cells.length; j++) {
            td = tr[i].cells[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    display = "";
                    break;
                }
            }
        }
        tr[i].style.display = display;
    }
}
        
    

</script>
</body>
</html>

