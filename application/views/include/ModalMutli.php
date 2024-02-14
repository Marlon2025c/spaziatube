<div class="modal fade" id="ModalSignaler" tabindex="-1" aria-labelledby="ModalLabelPartager" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabelSignaler">Signaler</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open('Media/Signaler/' . $id_video); ?>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" value="contenu-a-caractere-sexuel">
                    <label class="form-check-label" for="RadioSiganler">
                        Contenu à caractère sexuel
                    </label>
                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu comportant des images à caractère sexuel, des scénes de nudité et d'autre contenus à caractère sexuel">
                        <ion-icon class="ion-icon" name="alert-circle-outline">
                    </a>
                    <select class="form-select d-none select" name="Contenuacaracteresexuel" data-related-radio="contenu-a-caractere-sexuel">
                        <option value="" selected>Veuillez préciser :</option>
                        <option value="image-a-caractere-sexuel">Image à caractère sexuel</option>
                        <option value="nudite">Nudité</option>
                        <option value="contenu-suggestif-sans-nudite">Contenu suggestif, sans nudité</option>
                        <option value="contenu-impliquant-des-mineurs">Contenu impliquant des mineurs</option>
                        <option value="description-ou-titre-inappropries">Description ou titre inappropriés</option>
                        <option value="autre-contenu-à-caractere-sexuel">Autre contenu à caractère sexuel</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="contenu-violent-ou-abject">
                    <label class="form-check-label" for="RadioSiganler">
                        Contenu violent ou abject
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cotenu violent ou suscptible de choquer les utilisateurs">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="contenu-violent-ou-abject" data-related-radio="contenu-violent-ou-abject">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="bagarre-entre-adultes">Bagarre entre adultes</option>
                            <option value="agression-physique">Agression physique</option>
                            <option value="violence-impliquant-des-jeunes">Violence impliquant des jeunes</option>
                            <option value="mauvais-traitements-infliges-à-des-animaux">Mauvais traitements infligés à des animaux</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="contenu-abusif-ou-incitant-a-la-haine">
                    <label class="form-check-label" for="RadioSiganler">
                        Contenu abusif ou incitant à la haine
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu incitant à la haine contre des groupes protégés, insultent des personnes vulnérables ou encourageant le cyberharcèlement">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="contenu-abusif-ou-incitant-a-la-haine" data-related-radio="contenu-abusif-ou-incitant-a-la-haine">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="apologie-de-la-haine-ou-de-la-violence">Apologie de la haine ou de la violence</option>
                            <option value="abus-sur-des-personnes-vulérables">Abus sur des personnes vulérables</option>
                            <option value="description-ou-titre-inappropriees">Description ou titre inappropriées</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="harcelement-ou-intimidation">
                    <label class="form-check-label" for="RadioSiganler">
                        Harcèlement ou intimidation
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vidéos contenant des menaces à l'encontre d'individus ou les insultant de manière répétée ou malveillante">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="harcelement-ou-intimidation" data-related-radio="harcelement-ou-intimidation">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="harcelement-a mon-egard">Harcèlement à mon égard</option>
                            <option value="harcelement-a-legard-dun-autre-personne">Harcélement à l'égard d'un autre personne</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="actes-dangereux-ou-pernicieux">
                    <label class="form-check-label" for="RadioSiganler">
                        Actes dangereux ou pernicieux
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu incluant des actes pouvant engendrer des blessures physiques">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="actes-dangereux-ou-pernicieux" data-related-radio="actes-dangereux-ou-pernicieux">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="consommation-de-drogues-ou-de-produits-pharmaceutiques">Consommation de drogues ou de produits pharmaceutiques</option>
                            <option value="utilisation-abusive-du-feu-ou-dexplosifs">Utilisation abusive du feu ou d'explosifs</option>
                            <option value="suicide-ou-automutilation">Suicide ou automutilation</option>
                            <option value="autres-actes-dangereux">Autres actes dangereux</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="informations-incorrectes">
                    <label class="form-check-label" for="RadioSiganler">
                        Informations incorrectes
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu trompeur ou mensonger présentant un risque important de préjudice majeur">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="maltraitance-denfants">
                    <label class="form-check-label" for="RadioSiganler">
                        Maltraitance d'enfants
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu incluant des messages injurieux, à caractère sexuel ou relevant du harcèlement sur des mineurs">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="incitation-au-terrorisme">
                    <label class="form-check-label" for="RadioSiganler">
                        Incitation au terrorisme
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu visant à recuter des individus pour des organisations terroristes, incitant à la violence, célébrant des attaques terroristes ou faisant la promotion d'actes terroristes sous toute autre forme">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="spam-ou-contenu-trompeur">
                    <label class="form-check-label" for="RadioSiganler">
                        Spam ou contenu trompeur
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contenu publié en masse ou pouvant prêter a confusion">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="spam-ou-contenu-trompeur" data-related-radio="spam-ou-contenu-trompeur">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="publicité-de-masse">Publicité de masse</option>
                            <option value="vente-de-produits-pharmaceutiques">Vente de produits pharmaceutiques</option>
                            <option value="texte-mensonger">Texte mensonger</option>
                            <option value="miniature-pouvant-preter-a-confusion">Miniature pouvant prêter à confusion</option>
                            <option value="escroquerie-ou-fraude">Escroquerie ou fraude</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="non-respect-de-mes-droits">
                    <label class="form-check-label" for="RadioSiganler">
                        Non-respect de mes droits
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Réclamation relatives aux droits d'auteur, à la confidentialité ou à d'autre question d'ordre juridique">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="non-respect-de-mes-droits" data-related-radio="non-respect-de-mes-droits">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="probleme-lie-aux-droits-dauteur">Problème lié aux droits d'auteur</option>
                            <option value="probleme-de-confidentialité">Probléme de confidentialité</option>
                            <option value="atteinte-a-une-marque">Atteinte à une marque</option>
                            <option value="diffamation">Diffamation</option>
                            <option value="contrefaçon">Contrefaçon</option>
                            <option value="autre-probleme-dordre-juridique">Autre probléme d'ordre juridique</option>
                        </select>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input radio" type="radio" name="RadioSiganler" checked value="probleme-relatif-aux-sous-titres">
                    <label class="form-check-label" for="RadioSiganler">
                        Problème relatif aux sous-titres
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sous-titre manquants, inexcts ou abusifs">
                            <ion-icon class="ion-icon" name="alert-circle-outline"></ion-icon>
                        </a>
                        <select class="form-select d-none select" name="probleme-relatif-aux-sous-titres" data-related-radio="probleme-relatif-aux-sous-titres">
                            <option value="" selected>Veuillez préciser :</option>
                            <option value="sous-titres-manquants-CVAA">Sous-titres manquants (CVAA)</option>
                            <option value="sous-titres-inexacts">Sous-titres inexacts</option>
                            <option value="sous-titres-inappropries">Sous-titres inappropriés</option>
                        </select>
                    </label>
                </div>
                <div class="modal-footer">
                    <button class="d-none" id="submitinput" type="submit">Sauvegarder</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPartager" tabindex="-1" aria-labelledby="ModalLabelPartager" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabelPartager">Partager</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="text-center">
                        <a href="https://www.youtube.com/" target="_blank">
                            <ion-icon name="logo-youtube" class="ion-icon" style="color: red;"></ion-icon>
                            <h6>Youtube</h6>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="https://www.facebook.com/" target="_blank">
                            <ion-icon name="logo-facebook" class="ion-icon" style="color: #0165E1;"></ion-icon>
                            <h6>Facebook</h6>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="https://twitter.com/" target="_blank">
                            <ion-icon name="logo-twitter" class="ion-icon" style="color: #1D9BF0;"></ion-icon>
                            <h6>Twitter</h6>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="https://fr.linkedin.com/" target="_blank">
                            <ion-icon name="logo-linkedin" class="ion-icon" style="color: #0A66C2;"></ion-icon>
                            <h6>Linkedin</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalConnexion" tabindex="-1" aria-labelledby="ModalLabelPartager" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Connectez-vous pour donner votre avis.</h6>
                <div class="boxinfo_social">
                    <div class="boxinfo_social">
                        <div class="d-flex btnsocial boxinfo_social_pt">
                            <a href="<?= base_url("Users/login/"); ?>" class="d-flex align-items-center">
                                Connexion\Inscription
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>