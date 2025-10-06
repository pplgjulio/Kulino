<?php include("./includes/koneksi.php"); ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Kulino — Game Hub (Phantom / Solana demo)</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- bs58 for signature encoding -->
  <script src="https://cdn.jsdelivr.net/npm/bs58/dist/index.min.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="./css/style-index.css" />
</head>

<div class="bg-gray-100 text-gray-900">
  <!-- Overlay Loading -->
  <div
      id="loadingOverlay"
      class="fixed inset-0 bg-white flex flex-col items-center justify-center z-50"
    >
      <img
        src="assets/gif/loading.gif"
        alt="Loading..."
        class="w-20 h-20 animate-bounce"
      />

      <p class="mt-4 text-gray-700 font-semibold animate-pulse">Loading</p>
    </div>

  <section class="max-w-6xl mx-auto px-2 py-4 flex justify-end">
    <div class="text-right">
      <p>
        Viewers:
        <span id="visitorCount" class="font-bold text-indigo-600">0</span>
      </p>
    </div>
  </section>

  <!-- Header -->

  <!-- Header -->
  <header id="mainHeader" class="bg-white/50 backdrop-blur sticky top-0 z-40 transition-all duration-300">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-start gap-3">
        <div class="w-10 h-10">
          <img src="assets/icon/kulino-logo-blue.png" alt="Kulino Logo" class="w-full h-full object-contain" />
        </div>
        <div class="flex flex-col">
          <h1 class="text-base sm:text-lg font-semibold leading-snug">
            Kulino Game Hub — Prototype (Solana / Phantom)
          </h1>
          <p class="text-xs text-gray-500 mt-1">
            Connect Phantom → pilih game → play → klaim reward
          </p>
        </div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden sm:flex items-center gap-3">
        <button id="connectBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow">
          Connect Wallet
        </button>
      </div>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-10">
  
    <!-- Section Hero -->
    <section class="mb-8 relative overflow-hidden rounded-2xl shadow-sm">
      <!-- Video Background -->
      <video autoplay muted loop playsinline 
    class="absolute inset-0 w-full h-full object-cover"> 
    <source src="assets/video/video-lino.mp4" type="video/mp4" />
  </video>

      <!-- Overlay konten -->
      <div class="relative z-10 p-6 flex flex-col md:flex-row gap-6 bg-white/40  rounded-2xl">
        <div class="flex-1 bg-white/70 p-4 rounded-xl">
          <h2 class="text-xl sm:text-2xl font-bold">
            Selamat datang! Pilih game lalu tekan Play
          </h2>
          <p class="text-gray-700 mt-2 text-sm sm:text-base">
            Sambungkan Phantom terlebih dahulu. Setelah connect, alamat akan
            diteruskan ke game (Unity WebGL) saat kamu tekan Play.
          </p>
        </div>

        <div class="w-full md:w-48 text-center bg-white/70 p-4 rounded-xl">
          <div class="text-xs text-gray-600 mb-2">Wallet Address</div>
          <div id="addrShort" class="bg-gray-100 p-3 rounded-lg text-sm break-all">
            -
          </div>
        </div>
      </div>
    </section>


    <!-- Game Unggulan -->
    <section class="mb-10">
      <h3 class="text-xl font-semibold mb-4">xTop Game</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <article class="featured-card relative bg-white rounded-2xl shadow-md overflow-hidden cursor-pointer"
          onclick="playGame('blox-d')">
          <img src="assets/game-free-fire.jpg" alt="Bloxd.io" class="w-full h-48 object-cover" />
          <!-- Video overlay -->
          <video class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-300" muted
            loop>
            <source src="assets/video/hover-ff.mp4" type="video/mp4" />
          </video>
          <!-- Label -->
          <span class="absolute top-2 left-2 bg-indigo-600 text-white text-xs px-2 py-1 rounded-md shadow">
            Updated
          </span>
          <div class="p-4">
            <h4 class="font-semibold text-lg">Free Fire</h4>
            <p class="text-sm text-gray-500">
              Game battle seperti point blank.
            </p>
          </div>
        </article>

        <!-- Card Unggulan 2 -->
        <article class="featured-card relative bg-white rounded-2xl shadow-md overflow-hidden cursor-pointer"
          onclick="playGame('brainrot-online')">
          <img src="assets/efootball.jpeg" alt="Brainrot Online" class="w-full h-48 object-cover" />
          <video class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-300" muted
            loop>
            <source src="assets/video/hover-pes.mp4" type="video/mp4" />
          </video>
          <span class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded-md shadow">
            Top Rated
          </span>
          <div class="p-4">
            <h4 class="font-semibold text-lg">Brainrot Online</h4>
            <p class="text-sm text-gray-500">Game multiplayer lucu & unik.</p>
          </div>
        </article>
      </div>
    </section>

    <section>
      <h3 class="text-xl font-semibold mb-4">Game List</h3>
      <div class="relative">
        <!-- Slider wrapper -->
        <div id="gamesSlider" class="flex overflow-x-auto gap-6 scroll-smooth no-scrollbar">
          <!-- Game Card -->
          <article
            class="game-card relative bg-white rounded-2xl shadow-md min-w-[220px] sm:min-w-[240px] md:min-w-[300px] overflow-hidden fade-in">
            <div class="relative">
              <img src="assets/game-free-fire.jpg" alt="Game 1" class="w-full h-40 object-cover" />
              <div class="overlay rounded-t-2xl"></div>
            </div>
            <div class="hidden sm:flex p-4 flex-col justify-between">
              <div>
                <h4 class="font-semibold text-lg">Simple Kulino — Demo</h4>
                <p class="text-sm text-gray-500 mt-1">
                  Game sederhana: tap untuk menang, dapat reward.
                </p>
              </div>
              <div class="flex gap-2 mt-4">
                <button
                  class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition-colors">
                  Play
                </button>
                <button
                  class="flex-1 px-3 py-2 bg-white border border-gray-200 rounded-md text-sm hover:bg-gray-50 transition-colors">
                  Preview
                </button>
              </div>
            </div>
          </article>

          <!-- Duplikat card lain ... -->
          <article
            class="game-card relative bg-white rounded-2xl shadow-md min-w-[280px] md:min-w-[320px] overflow-hidden fade-in">
            <div class="relative">
              <img src="assets/mobile-legends.jpg" alt="Game 1" class="w-full h-40 object-cover" />
              <div class="overlay rounded-t-2xl"></div>
            </div>
            <div class="hidden sm:flex p-4 flex-col justify-between">
              <div>
                <h4 class="font-semibold text-lg">Simple Kulino — Demo</h4>
                <p class="text-sm text-gray-500 mt-1">
                  Game sederhana: tap untuk menang, dapat reward.
                </p>
              </div>
              <div class="flex gap-2 mt-4">
                <button
                  class="flex-1 px-3 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition-colors">
                  Play
                </button>
                <button
                  class="flex-1 px-3 py-2 bg-white border border-gray-200 rounded-md text-sm hover:bg-gray-50 transition-colors">
                  Preview
                </button>
              </div>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="game-card bg-white rounded-2xl shadow-md min-w-[280px] md:min-w-[320px] overflow-hidden">
            <img src="assets/mobile-legends.jpg" alt="Game 2" class="w-full h-40 object-cover" />
            <div class="hidden sm:block p-4">
              <h4 class="font-semibold text-lg">Forest Battle</h4>
              <p class="text-sm text-gray-500 mt-1">
                Coming soon — quick battle.
              </p>
            </div>
          </article>

          <!-- Card 4 -->
          <article class="game-card bg-white rounded-2xl shadow-md min-w-[280px] md:min-w-[320px] overflow-hidden">
            <img src="assets/mobile-legends.jpg" alt="Game 2" class="w-full h-40 object-cover" />
            <div class="hidden sm:block p-4">
              <h4 class="font-semibold text-lg">Forest Battle</h4>
              <p class="text-sm text-gray-500 mt-1">
                Coming soon — quick battle.
              </p>
            </div>
          </article>
        </div>

        <!-- Navigation Buttons -->
        <button onclick="scrollSlider('gamesSlider', -1)"
          class="hidden sm:block absolute top-1/2 -left-4 transform -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-gray-100">
          <!-- Heroicon left -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <button onclick="scrollSlider('gamesSlider', 1)"
          class="hidden sm:block absolute top-1/2 -right-4 transform -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-gray-100">
          <!-- Heroicon right -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
    </section>

    <section class="mt-10">
      <h3 class="text-lg font-semibold mb-3">Unity Preview (embedded)</h3>
      <div id="unityWrap" class="bg-white border border-gray-100 rounded-xl p-4">
        <div id="unityContainer" class="w-full h-[420px] bg-black/5 rounded-lg flex items-center justify-center">
          <div id="unityPlaceholder" class="text-gray-400">
            Unity not loaded — pilih game & tekan Play
          </div>
        </div>
      </div>
    </section>
  </main>

  <main class="max-w-6xl mx-auto px-4 py-10">
    <section>
      <h3 class="text-xl font-semibold mb-4">Berita Terbaru</h3>
      <div class="relative">
        <div id="newsSlider" class="flex overflow-x-auto gap-6 scroll-smooth no-scrollbar">
          <?php
          $sql = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY id DESC");
          while ($row = mysqli_fetch_assoc($sql)) {
          ?>
            <article class="news-card bg-white rounded-2xl shadow-md min-w-[280px] md:min-w-[320px] overflow-hidden hover:shadow-lg transition flex flex-col">
              <div class="relative w-full aspect-square overflow-hidden">
                <img src="uploads/<?= $row['gambar'] ?>" alt="<?= htmlspecialchars($row['judul']) ?>"
                  class="absolute inset-0 w-full h-full object-cover" />
              </div>
              <div class="p-4 flex flex-col justify-between flex-1">
                <div>
                  <h4 class="font-semibold text-lg"><?= htmlspecialchars($row['judul']) ?></h4>
                  <p class="text-sm text-gray-500 mt-1">
                    <?= nl2br(substr($row['deskripsi'], 0, 80)) ?>...
                  </p>
                </div>
                <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"
                  class="mt-4 flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
                  Baca Selengkapnya
                </a>
              </div>
            </article>

          <?php } ?>
        </div>

        <!-- Tombol navigasi -->
        <button onclick="scrollSlider('newsSlider', -1)"
          class="absolute top-1/2 -left-4 transform -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-gray-100">
          ←
        </button>
        <button onclick="scrollSlider('newsSlider', 1)"
          class="absolute top-1/2 -right-4 transform -translate-y-1/2 bg-white shadow-md rounded-full p-2 hover:bg-gray-100">
          →
        </button>
      </div>

    </section>
  </main>

  <?php include("./includes/footer.php"); ?>

  <script src="./js/script-index.js"></script>
  </body>

</html>