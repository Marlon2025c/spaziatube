<div class="container boxhome">
    <div class="row">
        <?php foreach ($videos as $video) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <a href="<?= base_url('Media/video/' . $video['video_lien']); ?>" onclick="incrementViews(<?= $video['id_video'] ?>)">
                        <img class="card-img-top custom-card-image" src="/spaziatube/uploads/video/<?= $video['user_id']; ?>/bannier/<?= $video['video_bannier']; ?>" alt="Card image">
                    </a>
                    <div class="card-body row">
                        <div class="col-md-2 p-0">
                            <a href="<?= base_url('Media/profile/' . $video['key_profile']); ?>">
                                <?php if ($video['profile_image'] == 'defauft.png') { ?>
                                    <img class="img" src="/spaziatube/uploads/profile/defaut/<?= $video['profile_image']; ?>" alt="Profile Image">
                                <?php } else { ?>
                                    <img class="" src="/spaziatube/uploads/profile/<?= $video['id']; ?>/<?= $video['profile_image']; ?>" style="width: 50px; height: 50px; border-radius: 50px;" alt="Card image">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="col-md-10 boxvideo">
                            <?php if (strlen($video['titre']) > 50) : ?>
                                <h6 class="card-title"><b><?= substr($video['titre'], 0, 50) . '...'; ?></b></h6>
                            <?php else : ?>
                                <h6 class="card-title"><b><?= $video['titre']; ?></b></h6>
                            <?php endif; ?>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="card-text"><?= $video['pseudo']; ?></p>
                                </div>
                                <div class="d-flex">
                                    <p class="card-text"><?= $video['views_count']; ?> vue </p>&nbsp
                                    <p class="card-text">il y a : <?= timespan(strtotime($video['date_upload']), time(), 1); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>