    <!--------------------------------------- START FOOTER ------------------------------------------>
    <footer>
      <img src="<?= BASEURL ;?>/app/assets/img/logo2.png" alt="logo" />
      <div class="link">
        <h3>Kontak Kami</h3>
        <a href="mailto:220411100082@student.trunojoyo.ac.id">
          plantifygarden@gmail.com
        </a>
        <a href="https://wa.me/6281216505560">
          +62 812-1650-5560
        </a>
        <a href="https://wa.me/6288803528451">
          +62 888-0352-8451
        </a>
      </div>
      <div class="link">
        <h3>Link</h3>
        <a class="<?= $title == 'Beranda' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/index.php" ?>">Beranda</a>
        <a class="<?= $title == 'Produk' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/produk.php" ?>">Produk</a>
        <a class="<?= $title == 'Daftar Pesanan' ? 'active' : '' ?>" href="<?= BASEURL. "/app/customer/daftar_transaksi.php" ?>">Daftar Pesanan</a>
      </div>
    </footer>
    <div class="copyright">
      <h5>Copyright&copy;2023 PAW2023-1-E04</h5>
    </div>
    <!--------------------------------------------- END FOOTER -------------------------------------->
  </body>
</html>