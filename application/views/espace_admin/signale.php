<?php include(APPPATH . 'views/espace_admin/SideBar.php'); ?>
<div class="col-md-10">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>ID Signaler</th>
                <th>User ID</th>
                <th>Vidéos ID</th>
                <th>Raison</th>
                <th>Raison detail</th>
                <th>Date Signaler</th>
                <th>Titre</th>
                <th>Lien Vidéo</th>
            </tr>
        </thead>
        <?php foreach ($signaler as $signaler) : ?>
            <tbody>
                <tr>
                    <td><?= $signaler->id; ?></td>
                    <td><?= $signaler->user_id; ?></td>
                    <td><?= $signaler->id_video; ?></td>
                    <td><?= $signaler->raison; ?></td>
                    <td><?= $signaler->raison_detail; ?></td>
                    <td><?= timespan(strtotime($signaler->date_signale), time(), 2); ?></td>
                    <td><?= $signaler->video_titre; ?></td>
                    <td><a href="<?= base_url('Media/video/' . $signaler->video_lien) ?>"><?= $signaler->video_lien; ?></a></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>