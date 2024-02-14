<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/' . get_mode_stylesheet()); ?>.css">
    <link rel="icon" href="/spaziatube/assets/image/favicon.png">
    <title><?= $titre ?></title>

</head>

<body data-bs-theme="<?= get_mode_stylesheet() ?>">
    <nav class="navbar bg-body-tertiary p-3">
        <div class="container-fluid p-0">
            <a href="<?= base_url("Media");  ?>" class="navbar-brand">SpaziaTube</a>
            <?php if ($this->session->userdata('pseudo')) { ?>
                <div class="dropdown">
                    <a class="d-flex align-items-center text-end text-decoration-none" href="#" role="button" id="dropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <h3 class="custom-pl-10"><span class="spanps"><?= $this->session->userdata('pseudo') ?></span><br><span><?= $this->session->userdata('role_name') ?></span></h3>
                        <div class="col-auto">
                            <?php if ($this->session->userdata('profile_image') == 'defauft.png') { ?>
                                <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $this->session->userdata('profile_image') ?>" alt="Profile Image">
                            <?php } else { ?>
                                <img class="img" src="/spaziatube/uploads/profile/<?= $this->session->userdata('id') ?>/<?= $this->session->userdata('profile_image') ?>" alt="Profile Image">
                            <?php  } ?>

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0 custom-dropdown-menu" aria-labelledby="dropdownToggle">
                        <div class="limenunav">
                            <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url("Media"); ?>">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10" name="home-outline"></ion-icon>Home
                                </div>
                            </a>
                        </div>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <div class="limenunav">
                            <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url("Media/profile/" . $this->session->userdata('key_profile'));  ?>">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10" name="person-outline"></ion-icon>Votre Chaîne
                                </div>
                            </a>
                        </div>
                        <div class="limenunav">
                            <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url("Social/Tableaudebord/");  ?>">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10" name="podium-outline"></ion-icon>Tableau de bord
                                </div>
                            </a>
                        </div>
                        <?php if (IsAdmin() == TRUE) { ?>
                            <hr class="dropdown-divider">
                            <div class="limenunav">
                                <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url("Admin/");  ?>">
                                    <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                        <ion-icon class="custom-pl-10" name="construct-outline"></ion-icon>Panel
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                        <hr class="dropdown-divider">
                        <div class="limenunav">
                            <a class="p-2 d-flex align-items-stretch text-decoration-none" href="#">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10" name="help-circle-outline"></ion-icon>Help
                                </div>
                            </a>
                        </div>
                        <?php if (get_mode_stylesheet() == 'dark') : ?>
                            <div class="limenunav">
                                <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= site_url('users/setMode/light'); ?>">
                                    <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                        <ion-icon class="custom-pl-10" name="sunny-outline"></ion-icon>Mode clair
                                    </div>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="limenunav">
                                <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= site_url('users/setMode/dark'); ?>">
                                    <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                        <ion-icon class="custom-pl-10" name="moon-outline"></ion-icon>Mode sombre
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="limenunav">
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </div>
                        <div class="limenunav">
                            <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url("Users/deconnect/");  ?>">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10" name="log-out-outline"></ion-icon>Logout
                                </div>
                            </a>
                        </div>
                    </ul>
                </div>
            <?php } else { ?>
                <h3><a class="text-decoration-none spanps" href="<?= base_url("Users/login/");  ?>">Connexion\Inscription</a></h3>
            <?php } ?>
        </div>
    </nav>
    <?= $output ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/spaziatube/assets/js/main.js"></script>
    <script src="/spaziatube/assets/js/ajax.js"></script>


</body>

</html>