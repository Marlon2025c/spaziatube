<?php include(APPPATH . 'views/include/SideBar.php'); ?>
<div class="col-md-10" style="padding-top: 50px;">
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card card-profil-settings h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <?php if ($this->session->userdata('profile_image') == 'defauft.png') { ?>
                                        <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $this->session->userdata('profile_image') ?>" alt="Profile Image">
                                    <?php } else { ?>
                                        <img class="profil_video" src="/spaziatube/uploads/profile/<?= $this->session->userdata('id') ?>/<?= $this->session->userdata('profile_image') ?>" alt="Profil User">
                                    <?php } ?>
                                </div>
                                <h5 class="user-name"><?= $this->session->userdata('pseudo') ?></h5>
                                <h6 class="user-email"><?= $this->session->userdata('email') ?></h6>
                            </div>
                            <div class="about">
                                <h5 class="mb-2 text-primary">À propos</h5>
                                <p><?= $this->session->userdata('description') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card card-profil-settings h-100">
                    <div class="card-body">
                        <?= form_open_multipart('Users/Settings'); ?>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-3 text-primary">Détails personnels</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="pseudo">Pseudo</label>
                                    <input name="pseudo" type="text" class="form-control form-control-box" id="pseudo" placeholder="Entrer Pseudo">
                                    <div class="text-danger">
                                        <?= form_error('pseudo'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" class="form-control form-control-box" id="email" placeholder="Entrer Email">
                                    <div class="text-danger">
                                        <?= form_error('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mdp">Mot de passe</label>
                                    <input name="mdp" type="password" class="form-control form-control-box" id="mdp" placeholder="Entrer Mot de passe">
                                    <div class="text-danger">
                                        <?= form_error('mdp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="mdp_confirm">Confirmer votre Mot de passe</label>
                                    <input name="mdp_confirm" type="password" class="form-control form-control-box" id="mdp_confirm" placeholder="Confirmer votre Mot de passe">
                                    <div class="text-danger">
                                        <?= form_error('mdp_confirm'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="profile_fond">Profile Fond</label>
                                    <input name="profile_fond" type="file" class="form-control form-control-box" id="profile_fond">
                                    <div class="text-danger">
                                        <?php if (!empty($upload_error_fond)) : ?>
                                            <div class="error">
                                                <?= $upload_error_fond ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <input name="profile_image" type="file" class="form-control form-control-box" id="profile_image">
                                    <div class="text-danger">
                                        <?php if (!empty($upload_error_profile)) : ?>
                                            <div class="error">
                                                <?= $upload_error_profile ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control form-control-box" id="description" placeholder="Entrer la description de la chaîne"> </textarea>
                                    <div class="text-danger">
                                        <?= form_error('description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="img-container">
        <div class="profile_preview">
            <img class="imgprofile" src="/spaziatube/uploads/profile/<?= $this->session->userdata('profile_image') ?> " alt="Image de profile">
        </div>
        <div>
            <button type="button" id="profile_button"><ion-icon name="pencil-sharp"></ion-icon> Edit</button>
            <input type="file" id="profile_hidden" style="display: none;">
        </div>
    </div>

    <div id="popup" class="popup-overlay">
        <div class="popup-content">
            <span class="popup-close">&times;</span>
            <form class="popup-form" action="<?= base_url('Users/update_profile_image'); ?>" method="post" enctype="multipart/form-data">
                <label for="profile_image">Image de profil :</label>
                <div class="profile_preview">
                    <img id="image_preview" src="" alt="Aperçu de l'image">
                </div>
                <input type="file" name="profile_image" id="profile_image">
                <button type="submit">Sauvegarder</button>
            </form>
            <h4 class="formulaire_error"><?= form_error('profile_image'); ?></h4>
        </div>
    </div>
    <div>
        <form action="<?= base_url('Users/update_profile_fond'); ?>" method="post" enctype="multipart/form-data">
            <label for="profile_image">Fond de profil :</label>
            <input type="file" name="profile_fond">
            <button type="submit">Sauvegarder</button>
        </form>
        <h4 class="formulaire_error"><?= form_error('profile_fond'); ?></h4>
    </div>

    <div>
        <form action="<?= base_url('Users/description'); ?>" method="post">
            <label for="description">Description :</label>
            <input type="text" name="description">
            <button type="submit">Sauvegarder</button>
        </form>
        <h4 class="formulaire_error"><?= form_error('description'); ?></h4>
    </div> -->
</div>