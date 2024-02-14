<div class="row row_video">
    <div class="col-md-8 p-0">
        <div class="row">
            <video class="col-md-12" controls autoplay>
                <source src="<?= base_url('uploads/video/' . $user_id . '/' . $video_path); ?>" type="video/mp4">
                Votre navigateur ne prend pas en charge la lecture de vidéos.
                <a href="<?= base_url('uploads/video/' . $user_id . '/' . $video_path); ?>">la télécharger</a> !
            </video>
        </div>
        <h6 class="titre_video"><?= $titre ?></h6>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <a href="<?= base_url('Media/profile/' . $key_profile); ?>">
                    <?php if ($profile_image == 'defauft.png') { ?>
                        <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $profile_image ?>" alt="Profile Image">
                    <?php } else { ?>
                        <img class="profil_video" src="/spaziatube/uploads/profile/<?= $user_id ?>/<?= $profile_image ?>" alt="Profil User">
                    <?php } ?>
                </a>
                <div class="boxinfo_video">
                    <h6 class="m-0"><?= $pseudo ?></h6>
                    <span class="m-0 subscription-count"><?= $subscriptionCount ?> Abonnés</span>
                </div>

                <div class="p-2">
                    <?php if (IsConnected() == true) : ?>
                        <?php if ($isSubscribed) : ?>

                            <div class="boxinfo_social">
                                <div class="d-flex btnsocial boxinfo_social_pt">
                                    <a href="#" class="d-flex align-items-center unsubscribe-button" data-user-id="<?= $id ?>">
                                        <ion-icon name="person-remove-outline" class="dislike_ion"></ion-icon>
                                        Se désabonner
                                    </a>
                                </div>
                            </div>
                            <div class="boxinfo_social">
                                <div class="d-flex btnsocial boxinfo_social_pt">
                                    <a href="#" class="d-flex align-items-center subscribe-button d-none" data-user-id="<?= $id ?>">
                                        <ion-icon name="notifications-outline" class="dislike_ion"></ion-icon>
                                        S'abonner
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php if ($id != $loggedInUserId) : ?>

                                <div class="boxinfo_social">
                                    <div class="d-flex btnsocial boxinfo_social_pt">
                                        <a href="#" class="d-flex align-items-center unsubscribe-button d-none" data-user-id="<?= $id ?>">
                                            <ion-icon name="person-remove-outline" class="dislike_ion"></ion-icon>
                                            Se désabonner
                                        </a>
                                    </div>
                                </div>
                                <div class="boxinfo_social">
                                    <div class="d-flex btnsocial boxinfo_social_pt">
                                        <a href="#" class="d-flex align-items-center subscribe-button" data-user-id="<?= $id ?>">
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
            <div class="p-2">
                <div class="d-flex">
                    <?php if (IsConnected() == true) : ?>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial">
                                <div class="btnlike btn-profile">
                                    <a href="javascript:void(0);" class="d-flex align-items-center like-button" data-video-id="<?= $id_video ?>">
                                        <ion-icon name="thumbs-up-outline" class="like_ion"></ion-icon>
                                        <span class="like-count"><?= $likes_count ?></span>
                                    </a>
                                </div>

                                <div class="btndislike btn-profile">
                                    <a href="javascript:void(0);" class="d-flex align-items-center dislike-button" data-video-id="<?= $id_video ?>">
                                        <span class="dislike-count"><?= $dislikes_count ?></span>
                                        <ion-icon name="thumbs-down-outline" class="dislike_ion"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#ModalPartager">
                                    <ion-icon name="arrow-redo-outline" class="dislike_ion"></ion-icon>
                                    Partager
                                </a>
                            </div>
                        </div>

                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#ModalSignaler">
                                    <ion-icon name="flag-outline" class="dislike_ion"></ion-icon>
                                    Signaler
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial">
                                <div class="btnlike btn-profile">
                                    <a class="d-flex align-items-center comment-like-button" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                        <ion-icon name="thumbs-up-outline" class="like_ion"></ion-icon>
                                        <?= $likes_count ?>
                                    </a>
                                </div>
                                <div class="btndislike btn-profile">
                                    <a class="d-flex align-items-center comment-dislike-button" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                        <?= $dislikes_count ?>
                                        <ion-icon name="thumbs-down-outline" class="dislike_ion"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                    <ion-icon name="arrow-redo-outline" class="dislike_ion"></ion-icon>
                                    Partager
                                </a>
                            </div>
                        </div>

                        <div class="boxinfo_social">
                            <div class="d-flex btnsocial boxinfo_social_pt">
                                <a href="#" class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                    <ion-icon name="flag-outline" class="dislike_ion"></ion-icon>
                                    Signaler
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="video_description p-2">
            <div class="d-flex">
                <p><?= $views_count ?> vues</p>&nbsp <p>il y a : <?= timespan(strtotime($date_upload), time(), 1); ?></p>
            </div>
            <p>Tag de la video </p>
            <p><?= nl2br($description) ?></p>
        </div>

        <div>
            <p id="commentCount"><?= $commentaire_count ?> commentaire</p>
            <?php if (IsConnected() == true) { ?>
                <div>
                    <div class="d-flex">
                        <?php if ($this->session->userdata('profile_image') == 'defauft.png') { ?>
                            <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $this->session->userdata('profile_image') ?>" alt="Profile Image">
                        <?php } else { ?>
                            <img class="profil_video" src="/spaziatube/uploads/profile/<?= $this->session->userdata('id') ?>/<?= $this->session->userdata('profile_image') ?>" alt="Profil User">
                        <?php } ?>
                        <div class="box_commentaire w-100">
                            <textarea id="commentTextarea" class="form-control" name="commentTextarea" placeholder="Ajoutez un commentaire..." data-video-id="<?= $id_video ?>"></textarea>
                        </div>
                    </div>
                    <div id="commentButtons" class="d-none d-flex justify-content-end">
                        <button id="annulerBtn" class="btn btn-annuller_commentaire" type="button">Annuler</button>
                        <button id="commenterBtn" class="btn btn_commenter" disabled>Commenter</button>
                    </div>
                </div>
            <?php } else { ?>
                <textarea id="commentTextarea" class="form-control d-none" name="commentTextarea" placeholder="Ajoutez un commentaire..." data-video-id="<?= $id_video ?>"></textarea>
                <div id="commentButtons" class="d-none d-flex justify-content-end">
                    <button id="annulerBtn" class="btn btn-annuller_commentaire" type="button">Annuler</button>
                    <button id="commenterBtn" class="btn btn_commenter" disabled>Commenter</button>
                </div>
            <?php } ?>

            <?php if ($commentaire_video) : ?>

                <div id="commentaireContainer">
                    <?php foreach ($commentaire_video as $commentaire) : ?>
                        <div class="d-flex">
                            <?php if ($commentaire['profile_image'] == 'defauft.png') { ?>
                                <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $commentaire['profile_image'] ?>" alt="Profile Image">
                            <?php } else { ?>
                                <img class="profil_video" src="/spaziatube/uploads/profile/<?= $commentaire['id']; ?>/<?= $commentaire['profile_image']; ?>" alt="Profil User">
                            <?php } ?>
                            <div class="box_commentaire">
                                <div class="d-flex">
                                    <p> <?= $commentaire['pseudo']; ?></p> &nbsp
                                    <p> Il y a : <?= timespan(strtotime($commentaire['date_upload']), time(), 1); ?></p>
                                </div>
                                <p class="m-0 comment-text comment-content"><?= nl2br($commentaire['commentaire']); ?></p>
                                <div class="d-flex btnsocialcommenter">

                                    <?php if (IsConnected() == true) { ?>
                                        <div class="comment-like-section">
                                            <a href="javascript:void(0);" class="comment-like-button" data-comment-id="<?= $commentaire['id_com'] ?>">
                                                <ion-icon name="thumbs-up-outline" class="comment-like-icon"></ion-icon>
                                                <span class="comment-like-count" data-comment-id="<?= $commentaire['id_com'] ?>"><?= $commentaire_likes_counts[$commentaire['id_com']] ?></span>
                                            </a>
                                        </div>

                                        <div class="comment-dislike-section">
                                            <a href="javascript:void(0);" class="comment-dislike-button" data-comment-id="<?= $commentaire['id_com'] ?>">
                                                <span class="comment-dislike-count" data-comment-id="<?= $commentaire['id_com'] ?>"><?= $commentaire_dislikes_counts[$commentaire['id_com']] ?></span>
                                                <ion-icon name="thumbs-down-outline" class="comment-dislike-icon"></ion-icon>
                                            </a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="comment-like-section">
                                            <a class="comment-like-button" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                                <ion-icon name="thumbs-up-outline" class="comment-like-icon"></ion-icon>
                                                <span class="comment-like-count" data-comment-id="<?= $commentaire['id_com'] ?>"><?= $commentaire_likes_counts[$commentaire['id_com']] ?></span>
                                            </a>
                                        </div>
                                        <div class="comment-dislike-section">
                                            <a class="comment-dislike-button" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                                <span class="comment-dislike-count" data-comment-id="<?= $commentaire['id_com'] ?>"><?= $commentaire_dislikes_counts[$commentaire['id_com']] ?></span>
                                                <ion-icon name="thumbs-down-outline" class="comment-dislike-icon"></ion-icon>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div id="commentaireContainer">

                </div>

                <p id="aucunCommentaireMessage">Aucun commentaire pour le moment.</p>

            <?php endif; ?>
        </div>

    </div>



    <div class="col-md-4">
        <?php if ($similar_videos) { ?>
            <div class="p-2">
                Autre Video de <?= $pseudo ?> :
            </div>

            <?php foreach ($similar_videos as $similar_videos) : ?>
                <div class="col-md-12 box_video_lateral">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= base_url('Media/video/' . $similar_videos['video_lien']); ?>" onclick="incrementViews(<?= $similar_videos['id_video'] ?>)">
                                <img class="img_video_latera" src="/spaziatube/uploads/video/<?= $similar_videos['user_id']; ?>/bannier/<?= $similar_videos['video_bannier']; ?>" alt="Bannier video Lateral">
                            </a>
                        </div>
                        <div class="col-md-6 p-0">
                            <div>

                                <?php if (strlen($similar_videos['titre']) > 36) : ?>
                                    <h6 class="m-0 titre_video_lateral"><b><?= substr($similar_videos['titre'], 0, 36) . '...'; ?></b></h6>
                                <?php else : ?>
                                    <h6 class="m-0 titre_video_lateral"><b><?= $similar_videos['titre']; ?></b></h6>
                                <?php endif; ?>

                                <a href="<?= base_url('Media/profile/' . $similar_videos['key_profile']); ?>">
                                    <h6 class="m-0 autre_video_lateral"><?= $similar_videos['pseudo']; ?></h6>
                                </a>
                                <div class="d-flex">
                                    <p class="autre_video_lateral"><?= $similar_videos['views_count'] ?> vues &nbsp</p>
                                    <p class="autre_video_lateral">il y a : <?= timespan(strtotime($similar_videos['date_upload']), time(), 1); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } ?>

        <div class="p-2">
            Découvrez également :
        </div>
        <?php foreach ($random_videos as $random_videos) : ?>
            <div class="col-md-12 box_video_lateral">
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?= base_url('Media/video/' . $random_videos['video_lien']); ?>" onclick="incrementViews(<?= $random_videos['id_video'] ?>)">
                            <img class="img_video_latera" src="/spaziatube/uploads/video/<?= $random_videos['user_id']; ?>/bannier/<?= $random_videos['video_bannier']; ?>" alt="Bannier video Lateral">
                        </a>
                    </div>
                    <div class="col-md-6 p-0">
                        <div>

                            <?php if (strlen($random_videos['titre']) > 36) : ?>
                                <h6 class="m-0 titre_video_lateral"><b><?= substr($random_videos['titre'], 0, 36) . '...'; ?></b></h6>
                            <?php else : ?>
                                <h6 class="m-0 titre_video_lateral"><b><?= $random_videos['titre']; ?></b></h6>
                            <?php endif; ?>

                            <a href="<?= base_url('Media/profile/' . $random_videos['key_profile']); ?>">
                                <h6 class="m-0 autre_video_lateral"><?= $random_videos['pseudo']; ?></h6>
                            </a>
                            <div class="d-flex">
                                <p class="autre_video_lateral"><?= $random_videos['views_count']; ?> vues &nbsp</p>
                                <p class="autre_video_lateral">il y a : <?= timespan(strtotime($random_videos['date_upload']), time(), 1); ?></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include(APPPATH . 'views/include/ModalMutli.php'); ?>