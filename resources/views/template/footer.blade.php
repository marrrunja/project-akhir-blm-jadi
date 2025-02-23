<footer class="bg-ungu text-white pt-5 pb-4">
  <div class="container text-md-left">
    <div class="row text-md-left">
      <!-- Kolom 1 -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-white">Enigma</h5>
        <p>
          Website ini menyediakan berita terkini dengan berbagai kategori menarik. Dapatkan informasi terbaru hanya di sini.
        </p>
      </div>

      <!-- Kolom 2 -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-white">Kategori</h5>
        <p><a class="text-white" style="text-decoration: none;">Olahraga</a></p>
        <p><a class="text-white" style="text-decoration: none;">Kesehatan</a></p>
        <p><a class="text-white" style="text-decoration: none;">Kuliner</a></p>
      </div>

      <!-- Kolom 3 -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-white">Tautan Cepat</h5>
        <p><a href="/news" class="text-white" style="text-decoration: none;">Beranda</a></p>
        <p><a href="/user/news/{{ Session::get('id') }}" class="text-white" style="text-decoration: none;">Berita Saya</a></p>
        <p><a href="/about" class="text-white" style="text-decoration: none;">Tentang Kami</a></p>
        <p><a class="text-white" style="text-decoration: none;">Kontak</a></p>
      </div>

      <!-- Kolom 4 -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-white">Kontak</h5>
        <p><i class="fas fa-home mr-3"></i> Jambi, Indonesia</p>
        <p><i class="fas fa-envelope mr-3"></i> muammarirfan21@gmail.com</p>
        <p><i class="fas fa-phone mr-3"></i> +62 822 5530 1884</p>
        <p><i class="fas fa-print mr-3"></i> +62 812 3456 7891</p>
      </div>
    </div>

    <hr class="mb-4" style="border-top: 2px solid #ffffff;">

    <!-- Bagian bawah footer -->
    <div class="row align-items-center">
      <div class="col-md-7 col-lg-8">
        <p>© 2025 Hak Cipta <strong class="text-white">Enigma</strong> Semua Hak Dilindungi.</p>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-google-plus-g"></i></a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-instagram"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
