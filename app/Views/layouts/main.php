<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Batur Jeep Experience — Wisata Jeep Offroad Kintamani Bali') ?></title>
    <meta name="description" content="<?= esc($meta_description ?? 'Batur Jeep Experience — Wisata Jeep Offroad terbaik di Gunung Batur, Kintamani, Bali. Sunrise, Offroad Adventure, Private Trip. Pesan sekarang!') ?>">
    <meta name="keywords" content="batur jeep, wisata kintamani, offroad bali, jeep batur, sunrise batur, tour kintamani">
    <meta name="author" content="Batur Jeep Experience">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= esc($title ?? 'Batur Jeep Experience') ?>">
    <meta property="og:description" content="Wisata Jeep Offroad terbaik di Kintamani Bali">
    <meta property="og:type" content="website">

    <!-- Preconnect Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@600;700;800;900&family=Playfair+Display:ital,wght@1,400;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <?= $this->renderSection('head') ?>
</head>
<body>

    <!-- ═══════════════════════════════════════════════
         NAVBAR
    ════════════════════════════════════════════════ -->
    <?= $this->include('partials/navbar') ?>

    <!-- ═══════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════════ -->
    <main id="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ═══════════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════════ -->
    <?= $this->include('partials/footer') ?>

    <!-- ── Main JS ── -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>
</html>
