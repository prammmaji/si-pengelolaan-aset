<?php
$user_id = $_SESSION['alogin'];


?>
<header>
      <nav class="navbar">
        <a href="#" class="navbar-logo">Desa<span>BEJI</span>.</a>
        <div class="navbar-nav"></div>

        <div class="navbar-profil">
            <a href="profil.php" ><?php echo $user_id ?></a>
            |
            <a href="logout.php" >Logout</a>
        </div>
      </nav>
    </header>