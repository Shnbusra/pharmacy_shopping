<!DOCTYPE html>
<html lang="tr-TR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <form action="#" class="login-form">
    <h1>Oturum Aç</h1>
    <div class="textb">
      <input type="text" required>
      <div class="placeholder">Kullanıcı Adı</div>
    </div>

    <div class="textb">
      <input type="password" required>
      <div class="placeholder">Şifre</div>
    </div>

    <div class="checkbox">
      <input type="checkbox">
      <div class="fas fa-check"></div>
      Beni Hatırla
    </div>

    <button class="btn fas fa-arrow-right" disabled></button>
    <a href="#">Şifremi Unuttum</a>
    <a href="#">Hesap Oluşur</a>
  </form>

  <script>
    var fields = document.querySelectorAll(".textb input");
    var btn = document.querySelector(".btn");
    function check(){
      if(fields[0].value != "" && fields[1].value != "")
        btn.disabled = false;
      else
        btn.disabled = true;  
    }

    fields[0].addEventListener("keyup",check);
    fields[1].addEventListener("keyup",check);

  </script>
</body>
</html>