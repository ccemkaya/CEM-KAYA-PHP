<?php

session_start();

include 'conn.php';

$route = @$_GET["kategori"];

?>
<html lang="tr">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotunuPaylaş - Not paylaşım platformu!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NotunuPaylaş</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Notlar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Giriş Yap</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



  <div class="container-fluid mt-2" style="padding-left: 0 !important;">
    <div class="row">
      <div class="col-md-3">
        <div class="d-flex flex-column flex-shrink-0 p-4 text-dark" style="width: 100%;">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Kategoriler</span>
          </a>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <!-- <li class="nav-item">
              <a href="#" class="nav-link text-dark" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Matematik
              </a>
            </li> -->
            <?php
            
            $query = $db->query("SELECT * FROM kategoriler",PDO::FETCH_ASSOC);

            foreach($query as $row){
            echo '<li class="nav-item">
              <a href="index.php?kategori=' . $row["tag"] . '" class="nav-link text-dark" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                ' . $row["name"] . '
              </a>
            </li>';
            }
            
            ?>
          </ul>
          <hr>
        </div>
      </div>
      <div class="col-md-9">
        <div class="container mt-2">
          <div class="row">
            <?php
            
            if($route){
              $query = $db->query("SELECT * FROM notlar WHERE kategori='$route'",PDO::FETCH_ASSOC);
            
              foreach ($query as $row) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-3">
                <div class="card m-1">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["baslik"] . '</h5>
                    <p class="card-text">' . $row["aciklama"] . '</p>
                    <a href="' . $row["file"] . '" class="card-link">Notu İndir</a>
                  </div>
                </div>
            </div>';
              } 
            }else{
              $query = $db->query("SELECT * FROM notlar",PDO::FETCH_ASSOC);
            
              foreach ($query as $row) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-3">
                <div class="card m-1">
                  <div class="card-body">
                    <h5 class="card-title">' . $row["baslik"] . '</h5>
                    <p class="card-text">' . $row["aciklama"] . '</p>
                    <a href="indir.php?file=' . $row["file"] . '" class="card-link">Notu İndir</a>
                  </div>
                </div>
            </div>';
              }    
            }

            ?>
            <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-3">
                <div class="card m-1">
                  <div class="card-body">
                    <h5 class="card-title">Matematik</h5>
                    <p class="card-text">Gerçek sayıları anlatan matematik notu.</p>
                    <a href="#" class="card-link">Notu İndir</a>
                  </div>
                </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>  

    
    
</body>
</html>