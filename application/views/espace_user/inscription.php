<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card py-3 px-2 cardform">
                <p class="text-center mb-3 mt-2 titre-form" style="color: white;">S'INSCRIRE AVEC</p>
                <div class="row mx-auto ">
                    <div class="col-4">
                        <ion-icon class="fab fa-twitter" name="logo-twitter"></ion-icon>
                    </div>
                    <div class="col-4">
                        <ion-icon class="fab fa-facebook" name="logo-facebook"></ion-icon>
                    </div>
                    <div class="col-4">
                        <ion-icon class="fab fa-google" name="logo-google"></ion-icon>
                    </div>
                </div>
                <div class="division">
                    <div class="row">
                        <div class="col-3">
                            <div class="line l"></div>
                        </div>
                        <div class="col-6"><span style="color: white;">OU AVEC MON EMAIL</span></div>
                        <div class="col-3">
                            <div class="line r"></div>
                        </div>
                    </div>
                </div>
                <div class="myform" method="post">
                    <?= form_open(); ?>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
                        <div class="text-danger">
                            <?= form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" value="<?= set_value('pseudo'); ?>">
                        <div class="text-danger">
                            <?= form_error('pseudo'); ?>
                        </div>
                    </div>
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
                                <small><ion-icon class="far fa-user pr-2" name="person-outline"></ion-icon>S'inscrire</small>
                            </button>
                        </div>
                    </div>
                    <div style="color: white;" class="p-2">Dêja membre ?
                        <a class="bn" href="<?= base_url("users/login/"); ?>">Se connecter</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>