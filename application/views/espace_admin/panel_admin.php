<style>
    .canvausers {
        border-radius: 5%;
        background-image: -webkit-linear-gradient(90deg, #3f5efb 0%, #fc466b 100%);
    }

    .canvavideo {
        border-radius: 5%;
        background-image: -webkit-linear-gradient(90deg, #11998e 0%, #38ef7d 100%);
    }

    .canvacommentaire {
        border-radius: 5%;
        background-image: -webkit-linear-gradient(90deg, #ee0979 0%, #ff6a00 100%);
    }

    .canva {
        border-radius: 5%;
        background-image: linear-gradient(0, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 38%, rgba(0, 212, 255, 1) 100%);
    }
</style>
<?php include(APPPATH . 'views/espace_admin/SideBar.php'); ?>
<div class="col-md-10">
    <div class="row m-t-25 p-5">
        <div class="col-sm-6 col-lg-3 p-3">
            <div class="canvausers">
                <div class="d-flex justify-content-center align-items-center">
                    <ion-icon name="person-sharp" style="font-size: 25px; padding-right: 10px"></ion-icon>
                    <div>
                        <p id="totalUsersDisplay" class="m-0"></p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <canvas id="myChart" style="max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 p-3">
            <div class="canvavideo">
                <div class="d-flex justify-content-center align-items-center">
                    <ion-icon name="videocam-sharp" style="font-size: 25px; padding-right: 10px"></ion-icon>
                    <div>
                        <p id="totalVideosDisplay" class="m-0"></p>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <canvas id="myChart1" style="max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 p-3">
            <div class="canvacommentaire">
                <div class="d-flex justify-content-center align-items-center">
                    <ion-icon name="albums-sharp" style="font-size: 25px; padding-right: 10px"></ion-icon>
                    <div>
                        <p id="totalCommentaireDisplay" class="m-0"></p>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <canvas id="myChart2" style="max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 p-3">
            <div class="canva">
                <div class="d-flex justify-content-center align-items-center">
                    <ion-icon name="person-sharp" style="font-size: 25px; padding-right: 10px"></ion-icon>
                    <div>
                        <p id="totalSignalerDisplay" class="m-0"></p>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <canvas id="myChart3" style="max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-5">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Role</th>
                </tr>
            </thead>
            <?php foreach ($usersdata as $user) : ?>
                <tbody>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->pseudo; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->date; ?></td>
                        <td>
                            <?php if (($user->pseudo !== 'Marlon') && $user->id !== $this->session->userdata('id')) : ?>
                                <select class="grade-select userRoleSelector" data-userid="<?= $user->id; ?>">
                                    <?php foreach ($roles as $role) : ?>
                                        <?=
                                        $currentUserRole = $this->session->userdata('role_name');
                                        $isModerator = $currentUserRole === 'Modérateur';
                                        $isAdminOrModerator = $role->role_name === 'Administrateur' || $role->role_name === 'Modérateur';
                                        $isDisabled = $isModerator && $isAdminOrModerator;
                                        $isCurrentUser = ($user->id == $user_id);
                                        $isDisabled = $isDisabled || ($isModerator && $isCurrentUser);
                                        ?>
                                        <option value="<?= $role->role_id; ?>" <?= ($user->role_id == $role->role_id) ? 'selected' : ''; ?> <?= $isDisabled ? 'disabled' : ''; ?>>
                                            <?= $role->role_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else : ?>
                                <?php echo $user->role_name; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    // Faites une requête AJAX pour récupérer les données JSON depuis votre point de terminaison CodeIgniter
    fetch('/spaziatube/Admin/getUsersChartData')
        .then(response => response.json())
        .then(dataUsers => { // Utilisez le nom de variable dataUsers

            const totalUsers = dataUsers.totalUsers;

            // Afficher totalUsers dans l'élément HTML
            const totalUsersDisplay = document.getElementById('totalUsersDisplay');
            totalUsersDisplay.textContent = totalUsers + ' membres inscrits';

            delete dataUsers.totalUsers;

            const sortedDates = Object.keys(dataUsers)
                .map(dateStr => new Date(dateStr))
                .sort((a, b) => a - b);

            // Formatez les dates triées pour afficher le jour, le mois et l'année
            const formattedLabels = sortedDates.map(date => {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return date.toLocaleDateString('default', options);
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: formattedLabels,
                    datasets: [{
                        label: 'Utilisateurs',
                        data: Object.values(dataUsers), // Utilisez dataUsers ici
                        fill: false,
                        borderColor: 'white',
                        tension: 0.4,
                        fill: {
                            target: 'origin',
                            above: 'rgba(240, 240, 240, 0.2)',
                        },
                    }]
                },
                options: {
                    scales: {
                        y: {
                            display: false,
                        },
                        x: {
                            display: false,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
</script>
<script>
    const ctx1 = document.getElementById('myChart1');

    fetch('/spaziatube/Admin/getVideoChartData')
        .then(response => response.json())
        .then(dataVideo => {
            const totalVideos = dataVideo.totalVideos;

            // Afficher totalVideos dans l'élément HTML
            const totalVideosDisplay = document.getElementById('totalVideosDisplay');
            totalVideosDisplay.textContent = totalVideos + ' vidéos publiées';

            delete dataVideo.totalVideos;

            const sortedDates = Object.keys(dataVideo)
                .map(dateStr => new Date(dateStr))
                .sort((a, b) => a - b);

            // Formatez les dates triées pour afficher la date et l'heure
            const formattedLabels = sortedDates.map(date => {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };
                return date.toLocaleDateString('default', options);
            });

            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: formattedLabels,
                    datasets: [{
                        label: 'Vidéos',
                        data: Object.values(dataVideo),
                        fill: false,
                        borderColor: 'white',
                        tension: 0.4,
                        fill: {
                            target: 'origin',
                            above: 'rgba(240, 240, 240, 0.2)',
                        },
                    }]
                },
                options: {
                    scales: {
                        y: {
                            display: false,
                        },
                        x: {
                            display: false,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données vidéo:', error);
        });
</script>
<script>
    const ctx2 = document.getElementById('myChart2');

    fetch('/spaziatube/Admin/getCommentaireChartData')
        .then(response => response.json())
        .then(commentaireData => {
            const totalCommentaire = commentaireData.totalCommentaire;

            // Afficher totalCommentaire dans l'élément HTML
            const totalCommentaireDisplay = document.getElementById('totalCommentaireDisplay');
            totalCommentaireDisplay.textContent = totalCommentaire + ' Commentaires publiés';

            delete commentaireData.totalCommentaire; // Pas besoin de supprimer la propriété

            const sortedDates = Object.keys(commentaireData)
                .map(dateStr => new Date(dateStr))
                .sort((a, b) => a - b);

            // Formatez les dates triées pour afficher la date et l'heure
            const formattedLabels = sortedDates.map(date => {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };
                return date.toLocaleDateString('default', options);
            });

            new Chart(ctx2, { // Assurez-vous d'utiliser ctx2 au lieu de ctx1
                type: 'line',
                data: {
                    labels: formattedLabels,
                    datasets: [{
                        label: 'Commentaires',
                        data: Object.values(commentaireData), // Utilisez les données de commentaireData
                        fill: false,
                        borderColor: 'white',
                        tension: 0.4,
                        fill: {
                            target: 'origin',
                            above: 'rgba(240, 240, 240, 0.2)',
                        },
                    }]
                },
                options: {
                    scales: {
                        y: {
                            display: false,
                        },
                        x: {
                            display: false,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });

        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données commentaire:', error);
        });
</script>
<script>
    const ctx3 = document.getElementById('myChart3');

    fetch('/spaziatube/Admin/getSignalerChartData')
        .then(response => response.json())
        .then(DataSignaler => {
            const totalSignaler = DataSignaler.totalSignaler;

            // Afficher totalCommentaire dans l'élément HTML
            const totalSignalerDisplay = document.getElementById('totalSignalerDisplay');
            totalSignalerDisplay.textContent = totalSignaler + ' Vidéo Signaler';

            delete DataSignaler.totalSignaler; // Pas besoin de supprimer la propriété

            const sortedDates = Object.keys(DataSignaler)
                .map(dateStr => new Date(dateStr))
                .sort((a, b) => a - b);

            // Formatez les dates triées pour afficher la date et l'heure
            const formattedLabels = sortedDates.map(date => {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };
                return date.toLocaleDateString('default', options);
            });

            new Chart(ctx3, { // Assurez-vous d'utiliser ctx2 au lieu de ctx1
                type: 'line',
                data: {
                    labels: formattedLabels,
                    datasets: [{
                        label: 'Commentaires',
                        data: Object.values(DataSignaler), // Utilisez les données de commentaireData
                        fill: false,
                        borderColor: 'white',
                        tension: 0.4,
                        fill: {
                            target: 'origin',
                            above: 'rgba(240, 240, 240, 0.2)',
                        },
                    }]
                },
                options: {
                    scales: {
                        y: {
                            display: false,
                        },
                        x: {
                            display: false,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });

        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données des vidéo siganler:', error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.userRoleSelector').change(function() {
            var userRoleSelector = this;
            var selectedRoleId = $(userRoleSelector).val();
            var userId = $(userRoleSelector).data('userid');

            // Effectuez la requête AJAX pour mettre à jour le grade
            $.ajax({
                type: 'POST',
                url: '/spaziatube/Admin/updateUserRole',
                data: {
                    user_id: userId,
                    role_id: selectedRoleId
                },
                success: function(response) {
                    if (response.success) {
                        // Mise à jour réussie, effectuez les actions nécessaires ici
                        alert('Grade mis à jour avec succès.');
                    } else {
                        // Échec de la mise à jour, affichez un message d'erreur si nécessaire
                        alert('Échec de la mise à jour du grade.');
                    }
                },
                error: function() {
                    // Erreur lors de la requête AJAX, affichez un message d'erreur si nécessaire
                    alert('Erreur lors de la mise à jour du grade.');
                }
            });
        });
    });
</script>