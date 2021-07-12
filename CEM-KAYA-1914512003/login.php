<?php
session_start();

include("conn.php");

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $name = $_POST["username"];
    $pass = $_POST['password'];

    $query = $db->query("SELECT * FROM accounts WHERE username='$name'", PDO::FETCH_ASSOC);
    $row = $query->fetch();
    if ($row >= 1) {
        if ($pass === $row["password"]) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row["id"];
            header('Location: notlar.php');
        } else {
            echo 'Hatalı şifre kombinasyonu!';
        }

    } else {
        echo 'Hatalı kullanıcı adı bulunamadı!';
    }
}

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Giriş Yap - NotunuPaylaş</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="text-center">

<main class="form-signin">
    <form method="POST" action="login.php">
        <h1 class="h3 mb-3 fw-normal">Lütfen giriş yap</h1>

        <div class="form-floating">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="admin" required>
            <label for="floatingInput">Kullanıcı Adı</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password"  class="form-control" id="floatingPassword" placeholder="Şire" required>
            <label for="floatingPassword">Şifre</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş yap</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
</main>



</body>
</html>