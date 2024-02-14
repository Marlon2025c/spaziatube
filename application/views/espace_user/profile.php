<div>

    <div class="col-md-12">
        <?php if ($user['profile_fond'] == 'defauft_fond.png') { ?>
            <div style="background-image: url(/spaziatube/uploads/profile/defaut/<?= $user['profile_fond']; ?>); height: 400px; background-size: cover; background-repeat: no-repeat ;background-position: center;"></div>
        <?php } else { ?>
            <div style="background-image: url(/spaziatube/uploads/profile/<?= $user['id'] ?>/fond/<?= $user['profile_fond']; ?>); height: 400px; background-size: cover; background-repeat: no-repeat ;background-position: center;"></div>
        <?php } ?>
    </div>


    <div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <div class="p-3">
                    <?php if ($this->session->userdata('profile_image') == 'defauft.png') { ?>
                        <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $this->session->userdata('profile_image') ?>" alt="Profile Image">
                    <?php } else { ?>
                        <img class="rounded-circle image-profile" src="/spaziatube/uploads/profile/<?= $this->session->userdata('id') ?>/<?= $this->session->userdata('profile_image') ?>" alt="Photo-Profile" style="width: 120px; height: 120px;" />
                    <?php } ?>
                    <span></span>
                </div>
                <div class="navprofile" style="padding: 35px 0;">
                    <h2 style="font-size: 22;"><?= $user['pseudo']; ?></h2>
                    <p style="font-size: 13;">
                        <span>@<?= $user['role_name']; ?></span>
                        <span><?= $subscriptionCount; ?> </span>Abonnés
                        <span>322 </span>Vidéos

                    </p>
                </div>
            </div>
            <div class="p-5">
                <?php if (IsConnected() == true) : ?>
                    <?php if ($isSubscribed) : ?>

                        <button class="button-profile button-profile-color-sd"><a href="<?= base_url('Social/subscription/' . $user['id']); ?>">Se désabonner</a></button>
                    <?php else : ?>
                        <?php if ($user['id'] != $loggedInUserId) : ?>
                            <button class="button-profile button-profile-color-sd"><a href=" <?= base_url('Social/subscription/' . $user['id']); ?>">S'abonner</a></button>
                        <?php else : ?>
                            <button class="button-profile"><a href="<?= base_url("Social/Tableaudebord/");  ?>">Gérer les vidéos</a></button>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else : ?>
                    <button class="button-profile"><a href=" <?= base_url("Users/login/");  ?>">Connexion\Inscription</a></button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="padding: 0px 20;">

            <a class="nav-link active" href="#">Accueil</a>

            <a class="nav-link active" href="<?= base_url('users/error'); ?>">Vidéo</a>

            <a class="nav-link active" href="<?= base_url('users/error'); ?>">En direct</a>

            <a class="nav-link" href="<?= base_url('users/error'); ?>">playlist</a>

            <a class="nav-link active" href="<?= base_url('users/error'); ?>">Communauté</a>

            <a class="nav-link" href="<?= base_url('users/error'); ?>">chaînes</a>

            <a class="nav-link" href="<?= base_url('users/error'); ?>">à propos</a>
            </ul>
        </div>
    </nav>

</div>
<div class="col-md-2">
</div>
</div>