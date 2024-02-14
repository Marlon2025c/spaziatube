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
                    <div class="lisideBar <?php if (current_url() == base_url('Admin')) echo 'active-link'; ?>">
                        <a class="p-2 d-flex align-items-stretch text-decoration-none" href="<?= base_url('Admin') ?>">
                            <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                <ion-icon class="custom-pl-10 ion-icon" name="person-circle-outline"></ion-icon>Tableau de bord
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
                                <li class="p-2 SideBarTitre">Signaler</li>
                            </strong>
                        </h6>
                    </small>
                    <ul class="p-0">
                        <div class="lisideBar <?php if (current_url() == base_url('Admin/Signaler')) echo 'active-link'; ?>">
                            <a href="<?= base_url('Admin/Signaler') ?>" class="p-2 d-flex align-items-stretch text-decoration-none">
                                <div class="dropdown-item d-flex align-items-center flex-grow-1">
                                    <ion-icon class="custom-pl-10 ion-icon" name="warning-outline"></ion-icon>Vidéos Signaler
                                </div>
                            </a>
                        </div>
                    </ul>
                </ul>
            </ul>
        </div>
    </div>