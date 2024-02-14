<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card py-3 px-2 cardform">
                <p class="text-center mb-3 mt-2 titre-form" style="color: white;">SE CONNECTER AVEC</p>
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
                        <div class="col-6" style="color: white;"><span>OU AVEC MON EMAIL</span></div>
                        <div class="col-3">
                            <div class="line r"></div>
                        </div>
                    </div>
                </div>
                <div class="myform" method="post">
                    <?= form_open(); ?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Identifiant" name="identifiant">
                        <div class="text-danger">
                            <?= form_error('identifiant'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control passwords" placeholder="Mot de passe" name="mdp">
                        <div class="text-danger">
                            <?= form_error('mdp'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">

                        </div>
                        <div class="col-md-6 col-12">
                            <a class="bn" href="<?= base_url("users/recup_mdp/"); ?>">Mot se passe oublie</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block btn-primary btn-lg col-12">
                                <small><ion-icon class="far fa-user pr-2" name="person-outline" style="color: white;"></ion-icon>Se connecter</small>
                            </button>
                        </div>
                    </div>
                    <div class="p-2" style="color: white;">Toujours pas membre ?
                        <a class="bn" href="<?= base_url("users/inscription/"); ?>">S'inscrire</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>