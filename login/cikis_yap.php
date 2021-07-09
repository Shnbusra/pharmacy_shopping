<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Anasayfa</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div><!-- /.content-header -->
<div class="content">
<?php
        session_destroy();
		message("success","check"," Başarılı", "Başarılı bir şekilde çıkış yaptınız. Lütfen bekleyiniz yönlendiriliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login", true, 303);
?>
</div>