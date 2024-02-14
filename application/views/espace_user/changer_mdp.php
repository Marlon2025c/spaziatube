<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card py-3 px-2 cardform">
                <div class="division">
                    <div class="row">
                        <div class="col-3">
                            <div class="line l"></div>
                        </div>
                        <div class="col-6"><span>MOT DE PASSE </span></div>
                        <div class="col-3">
                            <div class="line r"></div>
                        </div>
                    </div>
                </div>
                <div class="myform" method="post">
                    <?= form_open(); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
                        <div class="text-danger">
                            <?= form_error('mdp'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" name="mdp_confirm">
                        <div class="text-danger">
                            <?= form_error('mdp_confirm'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg col-12">
                                <small><ion-icon class="far fa-user pr-2" name="person-outline"></ion-icon>Envoyer</small>
                            </button>
                        </div>
                    </div>
                    <div class="p-2">Dêja membre ?
                        <a class="bn" href="<?= base_url("users/login/"); ?>">Se connecter</a>
                    </div>
                    <?= form_close(); ?>
                    <h4 class="formulaire_error">
                        <?php if (isset($info_mdp) && $info_mdp == 'good') { ?>
                            <p style="color: green;">Mot de passe mis à jour avec succès.</p>
                            <p style="color: green;">La page va être rafraîchie et vous allez être redirigé vers Home dans 5 secondes..</p>
                        <?php } ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>