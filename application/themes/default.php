<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/' . get_mode_stylesheet()); ?>.css">
    <link rel="icon" href="/spaziatube/assets/image/favicon.png">
    <title><?= $titre ?></title>

</head>

<body data-bs-theme="<?= get_mode_stylesheet() ?>">

    <?php include(APPPATH . "views/include/navbar.php") ?>
    <?= $output ?>
    <?php include(APPPATH . "views/include/footer.php") ?>

</body>

</html>