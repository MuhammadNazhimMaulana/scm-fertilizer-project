<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">   
    <!-- Link custom css -->
    <link rel="stylesheet" href="<?= base_url('css/auth.css')?>">
    
</head>
<body>

    <!-- Awal isi Auth -->
    <?= $this->renderSection('auth') ?>
    <!-- Akhir isi Auth -->
    

    <!-- Link JS Bootstrap -->
    <script src="<?= base_url('bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>