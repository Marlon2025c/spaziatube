<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Social extends CI_Controller
{
    public function subscriptionAjax()
    {
        if (IsConnected() == true) {
            $user_id = $this->session->userdata('id');
            $action = $this->input->post('action');
            $subscribedUserId = $this->input->post('user_id');

            if ($action === "subscribe") {
                $this->users_model->add_subscription($user_id, $subscribedUserId);
            } elseif ($action === "unsubscribe") {
                $this->users_model->remove_subscription($user_id, $subscribedUserId);
            }

            $subscriptionCount = $this->users_model->get_subscription_count($subscribedUserId);
            echo $subscriptionCount;
        }
    }

    function commenterAjax()
    {
        $this->form_validation->set_rules('commentTextarea', 'Commentaire', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $commentTextarea = htmlspecialchars($this->input->post('commentTextarea'));
            $user_id = $this->session->userdata('id');
            $date_upload = date('Y-m-d H:i:s');
            $videoId = $this->input->post('videoId');

            if ($lastCommentId = $this->users_model->add_commenter($commentTextarea, $user_id, $videoId, $date_upload)) {
                $newCommentCount = $this->users_model->getCommenterCount($videoId);
                $response = array(
                    'success' => true,
                    'newCommentCount' => $newCommentCount,
                    'profile_image' => $this->session->userdata('profile_image'),
                    'pseudo' => $this->session->userdata('pseudo'),
                    'time_ago' => timespan(strtotime($date_upload), time(), 1),
                    'commentaire' => nl2br($commentTextarea), // Utilisez le contenu du commentaire que vous avez ajouté
                    'commentId' => $lastCommentId, // Ajoutez l'ID du commentaire à la réponse
                    'likes' => 0,
                    'dislikes' => 0
                );
                echo json_encode($response);
                return;
            }
        }

        $response = array('success' => false);
        echo json_encode($response);
    }

    public function increment_views($video_id)
    {
        $this->users_model->increment_views($video_id);
    }

    public function Tableaudebord()
    {
        $this->layout->set_titre('SpaziaTube | Tableau de bord');
        $this->layout->view('espace_user/tableau_de_bord');
    }

    public function video_upload()
    {

        $this->form_validation->set_rules('video_bannier', 'Video Bannier', 'callback_validate_bannier');
        $this->form_validation->set_rules('video', 'Video', 'callback_validate_video');
        $this->form_validation->set_rules('titre', 'Titre', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == true) {

            $titre = htmlspecialchars($this->input->post('titre'));
            $description = htmlspecialchars($this->input->post('description'));
            $user_id = $this->session->userdata('id');

            $bannier_upload_dir = './uploads/video/' . $user_id . '/bannier';
            if (!is_dir($bannier_upload_dir)) {
                mkdir($bannier_upload_dir, 0777, true);
            }

            $video_upload_dir = './uploads/video/' . $user_id;
            if (!is_dir($video_upload_dir)) {
                mkdir($video_upload_dir, 0777, true);
            }

            $config['upload_path'] = $bannier_upload_dir;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 30720;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('video_bannier')) {
                $upload_data = $this->upload->data();
                $extension = $upload_data['file_ext'];
                $hash = sha1_file($upload_data['full_path']);
                $video_bannier = $hash . $extension;
                rename($upload_data['full_path'], $bannier_upload_dir . '/' . $video_bannier);
            } else {
                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('error_message', 'Erreur lors de l\'upload de la bannière : ' . $upload_error);
                redirect('Users/Settings');
            }

            $config['upload_path'] = $video_upload_dir;
            $config['allowed_types'] = 'mp4|mov|avi';
            $config['max_size'] = 512000;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('video')) {
                $upload_data = $this->upload->data();
                $hash = sha1_file($upload_data['full_path']);
                $video_path = $hash . '.mp4';
                rename($upload_data['full_path'], $video_upload_dir . '/' . $video_path);

                $video_lien = bin2hex(random_bytes(15));
                $date_upload = date('Y-m-d H:i:s');
                $this->users_model->video_upload($video_path, $video_lien, $titre, $description, $date_upload, $video_bannier, $user_id);
                redirect('Media');
            } else {
                $upload_error = $this->upload->display_errors();
                $this->session->set_flashdata('error_message', 'Erreur lors de l\'upload de la vidéo : ' . $upload_error);
                redirect('Social/video_upload');
            }
        }
    }
    public function validate_bannier()
    {
        // Vérifier si la bannière est correctement uploadée
        if (isset($_FILES['video_bannier']) && $_FILES['video_bannier']['error'] === UPLOAD_ERR_OK) {
            return true;
        } else {
            $this->form_validation->set_message('validate_bannier', 'Le champ {field} est requis.');
            return false;
        }
    }

    // Fonction de validation personnalisée pour la vidéo
    public function validate_video()
    {
        // Vérifier si la vidéo est correctement uploadée
        if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            return true;
        } else {
            $this->form_validation->set_message('validate_video', 'Le champ {field} est requis.');
            return false;
        }
    }
}
