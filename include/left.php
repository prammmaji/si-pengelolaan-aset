<nav class="left" >
  <ul>
    <li><a href="aset.php">Aset Desa</a></li>
    <li><a href="pinjaman.php">Daftar Pinjaman</a></li>
    <li><a href="user.php">Daftar User</a></li>
    <li>
      <a href="#" id="laporan-aset">Laporan aset</a>
      <ul class="laporan-submenu">
        <li><a href="laporan_pengadaan.php">Laporan Pengadaan</a></li>
        <li><a href="laporan_penghapusan.php">Laporan Penghapusan</a></li>
      </ul>
    </li>
    <li><a href="laporan_peminjaman.php">Laporan Peminjaman</a></li>
  </ul>
  </nav>
  <script>
  const laporanAsetMenu = document.querySelector('#laporan-aset');
  const laporanSubMenu = document.querySelector('.laporan-submenu');

  laporanAsetMenu.addEventListener('click', () => {
    laporanSubMenu.classList.toggle('show');
  });

  function toggleNav() {
  var nav = document.querySelector('.left');
  nav.classList.toggle('show');
}

var toggleBtn = document.querySelector('#toggle-nav');
toggleBtn.addEventListener('click', toggleNav);
</script>

<style>
  .laporan-submenu {
    display: none;
    margin-left: 10px; /* add some margin to the left to indent the submenu */
  }

  .laporan-submenu li {
    margin-left: 10px; /* add some margin to the left to indent the menu items */
  }

  .laporan-submenu.show {
    display: block;
  }
  
</style>