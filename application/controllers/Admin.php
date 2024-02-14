<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (IsAdmin() == false) {
            redirect('Media');
        }
    }
    public function index()
    {
        $user_data = $this->users_model->getAllUsersData('users');
        $roles = $this->users_model->getAllRoles();
        $data['usersdata'] = $user_data;
        $data['roles'] = $roles;
        $this->layout->set_titre('SpaziaTube | Panel Admin');
        $this->layout->view('espace_admin/panel_admin',  $data);
    }

    public function updateUserRole()
    {
        $userId = $this->input->post('user_id');
        $roleId = $this->input->post('role_id');

        $updateSuccess = $this->users_model->updateUserRole($userId, $roleId);
        header('Content-Type: application/json');
        echo json_encode(['success' => $updateSuccess]);
    }

    function Signaler()
    {
        $signaler = $this->users_model->getAllSiganle();
        $data['signaler'] = $signaler;
        $this->layout->view('espace_admin/signale', $data);
    }
    public function getUsersChartData()
    {
        $userData = $this->users_model->getUsersChartData('date', 'users');
        $totalUsers = $this->users_model->getTotalUsers('users');

        $dataUsers = array();
        foreach ($userData as $row) {
            $dataUsers[$row->date] = $row->nombre_users;
        }

        $dataUsers['totalUsers'] = $totalUsers;

        header('Content-Type: application/json');
        echo json_encode($dataUsers,  $totalUsers);
    }

    public function getVideoChartData()
    {
        $videoData = $this->users_model->getUsersChartData('date_upload', 'video');
        $totalVideos = $this->users_model->getTotalUsers('video');


        $dataVideo = array();
        foreach ($videoData as $row) {
            $dataVideo[$row->date] = $row->nombre_video;
        }

        $dataVideo['totalVideos'] = $totalVideos;

        header('Content-Type: application/json');
        echo json_encode($dataVideo,  $totalVideos);
    }
    public function getCommentaireChartData()
    {
        $commentaireDataDB = $this->users_model->getUsersChartData('date_upload', 'video_commentaire');
        $totalCommentaire = $this->users_model->getTotalUsers('video_commentaire');

        $commentaireData = array();
        foreach ($commentaireDataDB as $row) {
            $commentaireData[$row->date] = $row->nombre_video_commentaire;
        }

        $commentaireData['totalCommentaire'] = $totalCommentaire;

        header('Content-Type: application/json');
        echo json_encode($commentaireData, $totalCommentaire);
    }
    public function getSignalerChartData()
    {
        $SignalerData = $this->users_model->getUsersChartData('date_signale', 'video_signaler');
        $totalSignaler = $this->users_model->getTotalUsers('video_signaler');

        $DataSignaler = array();
        foreach ($SignalerData as $row) {
            $DataSignaler[$row->date] = $row->nombre_video_signaler;
        }

        $DataSignaler['totalSignaler'] = $totalSignaler;

        header('Content-Type: application/json');
        echo json_encode($DataSignaler, $totalSignaler);
    }
}
