<?php

session_start();

if($_SESSION['loggedin'] === TRUE){

}else{
    header('Location: index.php');    
}

include 'conn.php';

$random_hex = bin2hex(random_bytes(5));



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  $target_dir = "files/";
  $target_filee = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_filee,PATHINFO_EXTENSION));
  $target_file = $target_dir . $random_hex . "." . $imageFileType;
  $uploadOk = 1;

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "Bu dosya bir nota benzemiyor.";
    $uploadOk = 0;
  }

  // Check file size
  if (@$_FILES["fileToUpload"]["size"] > 500000) {
    echo "Dosya çok büyük.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"
  && $imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" ) {
    echo "Sadece doc, docx, pdf, png, jpg ve jpeg yüklenebilir.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Dosya yüklenemedi.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "Bu dosya ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " başarıyla yüklendi.";
      $result = $db->prepare("INSERT INTO notlar SET baslik=?,aciklama=?,file=?,kategori=?");
      
      $baslik = $_POST["baslik"];
      $aciklama = $_POST["aciklama"];
      $kategori = $_POST["kategori"];

      $result->execute(array($baslik,$aciklama,$target_file,$kategori));
    } else {
      echo "Bir sorun oldu";
    }
  }
}



?>

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Ekle - NotunuPaylaş</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<style>

body {
  min-height: 100vh;
  min-height: -webkit-fill-available;
}

html {
  height: -webkit-fill-available;
}

main {
  display: flex;
  flex-wrap: nowrap;
  height: 100vh;
  height: -webkit-fill-available;
  max-height: 100vh;
  overflow-x: auto;
  overflow-y: hidden;
}

.b-example-divider {
  flex-shrink: 0;
  width: 1.5rem;
  height: 100vh;
  background-color: rgba(0, 0, 0, .1);
  border: solid rgba(0, 0, 0, .15);
  border-width: 1px 0;
  box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.bi {
  vertical-align: -.125em;
  pointer-events: none;
  fill: currentColor;
}

.dropdown-toggle { outline: 0; }

.nav-flush .nav-link {
  border-radius: 0;
}

.btn-toggle {
  display: inline-flex;
  align-items: center;
  padding: .25rem .5rem;
  font-weight: 600;
  color: rgba(0, 0, 0, .65);
  background-color: transparent;
  border: 0;
}
.btn-toggle:hover,
.btn-toggle:focus {
  color: rgba(0, 0, 0, .85);
  background-color: #d2f4ea;
}

.btn-togglee {
  display: inline-flex;
  align-items: center;
  padding: .25rem .5rem;
  font-weight: 600;
  color: rgba(0, 0, 0, .65);
  background-color: transparent;
  border: 0;
}
.btn-togglee:hover,
.btn-togglee:focus {
  color: rgba(0, 0, 0, .85);
  background-color: #d2f4ea;
}


.btn-toggle::before {
  width: 1.25em;
  line-height: 0;
  content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
  transition: transform .35s ease;
  transform-origin: .5em 50%;
}

.btn-toggle[aria-expanded="true"] {
  color: rgba(0, 0, 0, .85);
}
.btn-toggle[aria-expanded="true"]::before {
  transform: rotate(90deg);
}

.btn-toggle-nav a {
  display: inline-flex;
  padding: .1875rem .5rem;
  margin-top: .125rem;
  margin-left: 1.25rem;
  text-decoration: none;
}
.btn-toggle-nav a:hover,
.btn-toggle-nav a:focus {
  background-color: #d2f4ea;
}

.scrollarea {
  overflow-y: auto;
}

.fw-semibold { font-weight: 600; }
.lh-tight { line-height: 1.25; }


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
    

</style>
<body style="background-color: rgba(0, 0, 0, .1);">
  <div class="container-fluid" style="padding-left: 0 !important; padding-top: 0 !important;">
    <div class="row" style="height:100%;">
      <div class="col-md-2" style="height:100%;">
        <div class=" p-3 text-white bg-dark" style="height:100%;">
          <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Admin</span>
          </a>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <li>
              <a href="#" class="nav-link active text-white">
                <i class="fas fa-file-word"></i>
                Notlar
              </a>
            </li>
            <li>
              <a href="kategoriler.php" class="nav-link text-white">
                <i class="fas fa-folders"></i>
                Kategoriler
              </a>
            </li>
          </ul>
          <hr>
          <ul class="nav nav-pills">
            <li>
              <a href="cikisyap.php" class="nav-link text-white">
                <i class="fas fa-sign-out-alt"></i>
                Çıkış Yap

              </a>
            </li>
          </ul>
        </div>  
      </div>
      <div class="col-md-10" style="height:100%;">
        <form class="bg-light p-4 rounded mt-4" action="notlar.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Başlık</label>
            <input type="text" name="baslik" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Açıklama</label>
            <input type="text" name="aciklama" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Dosya</label>
            <br>
            <input type="file" name="fileToUpload" class="form-control-file" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select" name="kategori" aria-label="Kategori seç" required>
            <?php
            
            $query = $db->query("SELECT * FROM kategoriler",PDO::FETCH_ASSOC);
            
            foreach ($query as $row) {
              echo '<option value="' . $row["tag"] . '">' . $row["name"] . '</option>';
            }
            ?>
          </select>
          </div>
          
          <button type="submit" name="submit" class="btn btn-primary">Ekle</button>
        </form>
      </div>
    </div>
  </div>  

  

  

  

<script>
    /* global bootstrap: false */
    (function () {
        'use strict'
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })()
</script>

</body>
</html>