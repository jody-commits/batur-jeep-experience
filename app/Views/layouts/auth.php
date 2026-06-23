<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Batur Jeep Experience') ?></title>
    <meta name="description" content="<?= esc($meta_description ?? 'Login atau daftar ke Batur Jeep Experience — wisata Jeep offroad terbaik di Kintamani, Bali.') ?>">

    <!-- Preconnect Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">

    <?= $this->renderSection('head') ?>
</head>
<body>

    <?= $this->renderSection('content') ?>

</body>
</html>
