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
                        <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $user['profile_image'] ?>" alt="Profile Image">
                    <?php } else { ?>
                        <img class="rounded-circle image-profile" src="/spaziatube/uploads/profile/<?= $user['id'] ?>/<?= $user['profile_image'] ?>" alt="Photo-Profile" style="width: 120px; height: 120px;" />
                    <?php } ?>
                    <span></span>
                </div>
                <div class="navprofile" style="padding: 35px 0;">
                    <h2 style="font-size: 22;"><?= $user['pseudo']; ?></h2>
                    <p style="font-size: 13;">
                        <span>@<?= $user['role_name']; ?></span>
                        <span class="m-0 subscription-count"><?= $subscriptionCount ?> Abonnés</span>
                        <span>322 </span>Vidéos

                    </p>
                </div>
            </div>
            <div class="p-5">
            <?php if (IsConnected() == true) : ?>
                <?php if ($isSubscribed) : ?>
                    <div class="boxinfo_social">
                        <div class="d-flex btnsocial boxinfo_social_pt">
                            <a href="#" class="d-flex align-items-center unsubscribe-button" data-user-id="<?= $user['id'] ?>">
                                <ion-icon name="person-remove-outline" class="dislike_ion"></ion-icon>
                                Se désabonner
                            </a>
                        </div>
                    </div>
                    <div class="boxinfo_social">
                        <div class="d-flex btnsocial boxinfo_social_pt">
                            <a href="#" class="d-flex align-items-center subscribe-button d-none" data-user-id="<?= $user['id'] ?>">
                                <ion-icon name="notifications-outline" class="dislike_ion"></ion-icon>
                                S'abonner
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <?php if ($user['id'] != $loggedInUserId) : ?>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center unsubscribe-button d-none" data-user-id="<?= $user['id'] ?>">
                                    <ion-icon name="person-remove-outline" class="dislike_ion"></ion-icon>
                                    Se désabonner
                                </a>
                            </div>
                        </div>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center subscribe-button" data-user-id="<?= $user['id'] ?>">
                                    <ion-icon name="notifications-outline" class="dislike_ion"></ion-icon>
                                    S'abonner
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="<?= base_url("Social/Tableaudebord/");  ?>" class="d-flex align-items-center">
                                    Gérer les vidéos
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else : ?>
                <div class="boxinfo_social">
                    <div class="d-flex btnsocial boxinfo_social_pt">
                        <a href="<?= base_url("Users/login/"); ?>" class="d-flex align-items-center">
                            Connexion\Inscription
                        </a>
                    </div>
                </div>
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