<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="index.php" class="w3-bar-item w3-button w3-wide">LOGO</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="artist-records.php" class="w3-bar-item w3-button"><i class="fa fa-microphone" aria-hidden="true"></i> Disco</a>
      <?php if (rolUserio() == "ROLE_ADMIN"): ?>
      <a href="usuarios.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i> Usuarios</a>        
      <a href="discos.php" class="w3-bar-item w3-button"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Disks</a>
      <?php endif ?>
    </div>
  </div>
</div>
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="index.php" class="w3-bar-item w3-button">HOME</a>
  <a href="artist-records.php" class="w3-bar-item w3-button"><i class="fa fa-microphone" aria-hidden="true"></i> Disco</a>
  <?php if (rolUserio() == "ROLE_ADMIN"): ?>
  <a href="usuarios.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i> Usuarios</a>        
  <a href="discos.php" class="w3-bar-item w3-button"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Disks</a>
  <?php endif ?>
</nav>