<div class="row SideBarRow" style="height: 100%;">
    <div class="col-md-12 col-lg-2 p-0 SideBarC">
        <div class="p-4">
            <ul class="p-0">
                <small>
                    <h6>
                        <strong>
                            <li class="p-2 SideBarTitre">MENU</li>
                        </strong>
                    </h6>
                </small>
                <ul class="p-0">
                    <div class="lisideBar <?php if (current_url() == base_url('Social/Tableaudebord')) echo 'active-link'; ?>">
                        <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url('Social/Tableaudebord') ?>">
                            <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                <ion-icon class="custom-pl-10 ion-icon" name="person-circle-outline"></ion-icon>Tableau de bord
                            </div>
                        </a>
                    </div>
                </ul>
                <ul class="p-0">
                    <div class="lisideBar <?php if (current_url() == base_url('Users/Settings')) echo 'active-link'; ?>">
                        <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url('Users/Settings') ?>">
                            <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                <ion-icon class="custom-pl-10 ion-icon" name="settings-outline"></ion-icon>Settings
                            </div>
                        </a>
                    </div>
                </ul>
            </ul>
            <ul class="p-0">
                <ul class="p-0">
                    <small>
                        <h6>
                            <strong>
                                <li class="p-2 SideBarTitre">Vidéo</li>
                            </strong>
                        </h6>
                    </small>
                    <ul class="p-0">
                        <div class="lisideBar <?php if (current_url() == base_url('Social/video_upload')) echo 'active-link'; ?>">
                            <a href="#" class="p-2 d-flex align-items-stretch text-decoration-none" data-bs-toggle="modal" data-bs-target="#ModalConnexion">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10 ion-icon" name="videocam-outline"></ion-icon>Upload
                                </div>
                            </a>
                        </div>
                    </ul>
                </ul>
            </ul>
        </div>
    </div>

    <style>
        /* Masquer l'élément input */
        .modal-upload-video input[type="file"] {
            display: none;
        }

        .modal-upload-video label {
            cursor: pointer;
        }

        /* Styliser l'icône comme un bouton */
        .custom-upload-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
        }

        .box-upload-video-condition {
            font-size: 11px;
        }

        .a-upload-video {
            color: #007bff;
        }

        .dragover {
            border: 2px dashed #007bff;
        }

        #dropZone {
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        #dropZone.dragover {
            border: 2px dashed #007bff;
        }

        .video_bannier {
            border: 2px dashed #007bff;
        }

        .input_upload_video {
            color: white;
            background: none;
            border: 1px solid white;
        }

        .input_upload_video::placeholder {
            color: white;

        }

        .input_upload_video:focus {
            background: none;
            border: 1px solid white;
        }
    </style>
    <form action="<?= base_url('Social/video_upload'); ?>" method="post" enctype="multipart/form-data" class="p-0" style="width: 0%;">
        <div class="modal fade" id="ModalConnexion" tabindex="-1" aria-labelledby="ModalLabelPartager" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Importer des vidéos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center modal-upload-video">
                            <input type="file" class="form-control" name="video" id="fileInput">
                            <label id="dropZone" for="fileInput">
                                <ion-icon class="ion-icon ion-icon-upload" name="cloud-upload-outline"></ion-icon>
                            </label>
                        </div>
                        <h6 class="col-md-12 d-flex justify-content-center">Glissez-déposez les fichiers vidéo que vous souhaitez mettre en ligne</h6>
                        <p class="d-flex justify-content-center">Vis vidéos resteront privées jusqu'à leur publication</p>
                        <div class="text-danger justify-content-center d-none">
                            <h6>Veuillez sélectionner un fichier MP4 ou MP3 valide.</h6>
                        </div>
                        <div class="modal-upload-video d-flex justify-content-center">
                            <input type="file" class="form-control" name="video2" id="fileInput2">
                            <label for="fileInput2" class="custom-upload-btn">
                                <ion-icon class="ionicon s-ion-icon" name="cloud-upload-outline"></ion-icon> Sélectionner un fichier
                            </label>
                        </div>
                        <div class="col-md-12 box-upload-video-condition">
                            <p>En mettant en ligne des vidéos sur Spaziatube, vous reconnaissez accepter les
                                <a class="a-upload-video" href="<?= base_url('Users/ConditionsUtilisation') ?>">Conditions d'utilisation</a> et le
                                <a class="a-upload-video" href="<?= base_url('Users/ReglementCommunaute') ?>">Règlementde la communauté</a> de Spaziatube
                            </p>
                            <p class="d-flex justify-content-center">
                                Veillez à ne pas enfreindre les droits d'auteur ni les droits à la vie privée d'autrui. <a class="a-upload-video" href="#">En savoir plus </a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ModalDeuxieme" tabindex="-1" aria-labelledby="ModalLabelPartager" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Détails de la vidéo : </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="p-2">
                        <label for="titre" class="form-label">Titre de la vidéo</label>
                        <input name="titre" type="titre" class="input_upload_video form-control" require>
                    </div>
                    <div class="p-2">
                        <label for="description" class="form-label">Description de la vidéo</label>
                        <textarea name="description" class="input_upload_video form-control" require></textarea>
                    </div>

                    <div class="modal-upload-video p-2">
                        <h6>Miniature</h6>
                        <p style="font-size: 11px;" class="m-0">Sélectionnez ou importez une image qui donne un apercu du contenu de votre viéo .Une</p>
                        <p style="font-size: 11px; padding-bottom: 5px;" class="m-0">bonne image se remarque et attire l'attention des spectateur . <a href=" #" En savoir plus></a></p>
                        <div>
                            <input id="video_bannier" type="file" class="form-control" name="video_bannier" require>
                            <label class="video_bannier p-2" for="video_bannier">
                                <img id="bannierPreview" src="" alt="Aperçu de la bannière" style="max-width: 100%; max-height: 75px;" class="d-none">
                                <div id="banniericone" class="d-flex justify-content-center">
                                    <ion-icon name="duplicate-outline"></ion-icon>
                                </div>
                                <p id="bannierP" class="d-flex justify-content-center m-0">Importer une</p>
                                <p id="bannierP2" class="d-flex justify-content-center m-0">miniature</p>
                            </label>
                        </div>
                        <div class="text-danger-miniture d-none">
                            <h6 style="color: red;">Veuillez sélectionner un fichier GIF, JPG, JPEG, PNG valide.</h6>
                        </div>
                        <div class="text-danger">
                            <?= form_error('video_bannier'); ?>
                        </div>
                    </div>

                    <div>
                        <input id="submitBtn" type="submit" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const dropZone = document.getElementById('dropZone');
            const errorMessage = $('.text-danger');

            // Gérer l'événement de glisser-déposer
            dropZone.addEventListener('dragenter', function(e) {
                e.preventDefault();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('dragover');

                // Récupérer le fichier déposé
                const file = e.dataTransfer.files[0];

                if (file) {
                    // Obtenir l'extension du fichier en convertissant le nom de fichier en minuscules
                    const fileName = file.name.toLowerCase();
                    const fileExtension = fileName.split('.').pop();

                    // Vérifier si l'extension est MP4 ou MP3
                    if (fileExtension === 'mp4' || fileExtension === 'mov' || fileExtension === 'avi') {
                        // Fermer la première modal
                        $('#ModalConnexion').modal('hide');

                        // Ouvrir la deuxième modal (ajustez l'ID de la modal)
                        $('#ModalDeuxieme').modal('show');

                        // Cacher le message d'erreur s'il était affiché précédemment
                        errorMessage.addClass('d-none');
                    } else {
                        // Afficher le message d'erreur
                        errorMessage.removeClass('d-none');
                        errorMessage.addClass('d-flex');
                    }
                }
            });

            // Gérer l'événement de changement de fichier (pour les utilisateurs qui ne font pas glisser-déposer)
            $('#fileInput').change(function() {
                // Récupérer le fichier sélectionné par l'utilisateur
                const file = this.files[0];

                if (file) {
                    // Obtenir l'extension du fichier en convertissant le nom de fichier en minuscules
                    const fileName = file.name.toLowerCase();
                    const fileExtension = fileName.split('.').pop();

                    // Vérifier si l'extension est MP4 ou MP3
                    if (fileExtension === 'mp4' || fileExtension === 'mov' || fileExtension === 'avi') {
                        // Fermer la première modal
                        $('#ModalConnexion').modal('hide');

                        // Ouvrir la deuxième modal (ajustez l'ID de la modal)
                        $('#ModalDeuxieme').modal('show');

                        // Cacher le message d'erreur s'il était affiché précédemment
                        errorMessage.addClass('d-none');
                    } else {
                        // Afficher le message d'erreur
                        errorMessage.removeClass('d-none');
                        errorMessage.addClass('d-flex');
                    }
                }
            });
            $('#video_bannier').change(function() {
                // Récupérer le fichier sélectionné par l'utilisateur
                const file = this.files[0];

                // Sélectionnez l'élément d'image
                const errorMessageminiature = $('.text-danger-miniture');
                const elementsToHide = $('.hide-on-image');
                const bannierPreview = $('#bannierPreview');
                const banniericone = $('#banniericone');
                const bannierP = $('#bannierP');
                const bannierP2 = $('#bannierP2');

                if (file) {
                    // Créer un objet URL pour l'aperçu de l'image
                    const imageURL = URL.createObjectURL(file);
                    const fileName = file.name.toLowerCase();
                    const fileExtension = fileName.split('.').pop();
                    if (['gif', 'jpg', 'jpeg', 'png'].includes(fileExtension)) {
                        // Afficher l'image dans l'élément <img>
                        bannierPreview.attr('src', imageURL);
                        bannierPreview.removeClass('d-none');
                        bannierP.addClass('d-none');
                        bannierP2.addClass('d-none');
                        banniericone.addClass('d-none');
                    } else {
                        errorMessageminiature.removeClass('d-none');
                    }
                } else {
                    bannierPreview.addClass('d-none');
                }
            });

        });
    </script>
    <script>
        const titreInput = $('input[name="titre"]');
        const descriptionTextarea = $('textarea[name="description"]');
        const videoBannierInput = $('#video_bannier');
        const submitBtn = $('#submitBtn');

        // Fonction pour vérifier si les champs sont vides
        function checkFields() {
            const titreValue = titreInput.val();
            const descriptionValue = descriptionTextarea.val();
            const videoBannierValue = videoBannierInput.val();

            // Vérifiez si les champs sont vides
            const fieldsEmpty = titreValue === '' || descriptionValue === '' || videoBannierValue === '';

            // Désactivez ou activez le bouton de soumission en fonction de l'état des champs
            if (fieldsEmpty) {
                submitBtn.attr('disabled', 'disabled');
            } else {
                submitBtn.removeAttr('disabled');
            }
        }

        // Appelez la fonction lorsqu'un champ est modifié
        titreInput.on('input', checkFields);
        descriptionTextarea.on('input', checkFields);
        videoBannierInput.on('change', checkFields);
    </script>