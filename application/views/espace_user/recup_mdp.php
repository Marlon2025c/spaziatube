<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card py-3 px-2 cardform">
                <div class="division">
                    <div class="row">
                        <div class="col-3">
                            <div class="line l"></div>
                        </div>
                        <div class="col-6"><span>Mot de passe Oublié ?</span></div>
                        <div class="col-3">
                            <div class="line r"></div>
                        </div>
                    </div>
                </div>
                <div class="myform" method="post">
                    <?= form_open(); ?>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Entrer votre email" name="email">
                        <div class="text-danger">
                            <?= form_error('mdp'); ?>
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
                    <h4 class="formulaire_error"><?php if (isset($info_connexion) && $info_connexion == 'error') echo ('<p style="color: red;">Le Mail est pas connue</p>'); ?> </h4>
                    <h4 class="formulaire_error"> <?php if (isset($mail_good) && $mail_good == 'good') echo ('<p style="color: green;">Le Mail a éte envoyé</p>'); ?></h4>
                    <h4 class="formulaire_error"> <?php if (isset($mail_error) && $mail_error == 'error') echo ('<p style="color: green;">Le Mail na pas éte envoyé</p>'); ?></h4>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>