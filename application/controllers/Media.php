<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{
    /* -------------------------------------------------------------------------- */
    /* Pour voir les vidéo poster dans la vue home qui et la page de base du site */
    /* -------------------------------------------------------------------------- */
    public function index()
    {
        $videos = $this->users_model->get_all_video();
        $data['videos'] = $videos;
        $this->layout->set_titre('SpaziaTube');
        $this->layout->view('espace_user/home', $data);
    }
    /* ---------------------------------------------  */
    /* Pour voir les porfile de tout les utilisateur  */
    /* ---------------------------------------------  */
    public function profile($key_profile = '')
    {
        $data = array(
            'key_profile' => $key_profile
        );

        if ($this->users_model->is_valid($data)) {
            $user_data['user'] = $this->users_model->get_user_profile($data);
            if ($user_data['user']) {
                $user_data['isSubscribed'] = $this->users_model->is_user_subscribed($user_data['user']['id']);
                $user_data['loggedInUserId'] = $this->session->userdata('id');
                // Obtenir le nombre d'abonnés de l'utilisateur
                $user_data['subscriptionCount'] = $this->users_model->get_subscription_count($user_data['user']['id']);

                $this->layout->set_titre('SpaziaTube | Profil');
                $this->layout->view('espace_user/profile', $user_data);
            } else {
                redirect('Media');
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function video($video_lien = '')
    {
        $data = array(
            'video_lien' => $video_lien
        );
        $video_info = $this->users_model->get_video_info($data);

        if ($video_info) {

            $video_info['isSubscribed'] = $this->users_model->is_user_subscribed($video_info['user_id']);
            $video_info['loggedInUserId'] = $this->session->userdata('id');
            $commentaire_video = $this->users_model->get_commentaires_videos($video_info['id_video']);

            $commentaire_likes_counts = array();
            $commentaire_dislikes_counts = array();

            foreach ($commentaire_video as $commentaire) {
                $commentaire_likes_counts[$commentaire['id_com']] = $this->users_model->getCommentLikesCount($commentaire['id_com']);
                $commentaire_dislikes_counts[$commentaire['id_com']] = $this->users_model->getCommentDislikesCount($commentaire['id_com']);
            }

            $video_info['likes_count'] = $this->users_model->getLikesCount($video_info['id_video']);
            $video_info['dislikes_count'] = $this->users_model->getDislikesCount($video_info['id_video']);
            $video_info['subscriptionCount'] = $this->users_model->get_subscription_count($video_info['user_id']);
            $video_info['commentaire_count'] = $this->users_model->getCommenterCount($video_info['id_video']);
            $video_info['commentaire_likes_counts'] = $commentaire_likes_counts;
            $video_info['commentaire_dislikes_counts'] = $commentaire_dislikes_counts;

            $similar_videos = $this->users_model->get_similar_videos($video_info['user_id'], $video_info['user_id'], 5);


            $random_videos = $this->users_model->get_random_videos($video_info['user_id'], 8);

            $video_info['commentaire_video'] = $commentaire_video;
            $video_info['random_videos'] = $random_videos;
            $video_info['similar_videos'] = $similar_videos;
            $this->layout->set_titre('SpaziaTube | Vidéo');
            $this->layout->view('espace_media/video', $video_info,);
        } else {
            echo ('error video info');
        }
    }

    public function addLikeDislikeAjax()
    {
        if (IsConnected() == true) {
            $user_id = $this->session->userdata('id');
            $video_id = $this->input->post('video_id');
            $type = $this->input->post('type');

            $this->users_model->addLikeDislike($user_id, $video_id, $type);
            $likes = $this->users_model->getLikesCount($video_id);
            $dislikes = $this->users_model->getDislikesCount($video_id);

            $response = array('likes' => $likes, 'dislikes' => $dislikes);
            echo json_encode($response);
        }
    }

    public function addCommentLikeDislikeAjax()
    {
        if (IsConnected() == true) {
            $user_id = $this->session->userdata('id');
            $comment_id = $this->input->post('comment_id');
            $type = $this->input->post('type');

            $this->users_model->addCommentLikeDislike($user_id, $comment_id, $type);
            $likes = $this->users_model->getCommentLikesCount($comment_id);
            $dislikes = $this->users_model->getCommentDislikesCount($comment_id);

            $response = array(
                'likes' => $likes,
                'dislikes' => $dislikes,
            );
            echo json_encode($response);
        }
    }

    function Signaler($video_id)
    {
        if (IsConnected() == true) {
            $this->form_validation->set_rules('RadioSiganler', 'Radio Siganler', 'required');
            $this->form_validation->set_rules('Contenuacaracteresexuel', 'Contenua a caractere sexuel', 'in_list[image-a-caractere-sexuel,nudite,contenu-suggestif-sans-nudite,contenu-impliquant-des-mineurs,description-ou-titre-inappropries,autre-contenu-à-caractere-sexuel]');
            $this->form_validation->set_rules('contenu-violent-ou-abject', 'Contenua a caractere sexuel', 'in_list[bagarre-entre-adultes,agression-physique,violence-impliquant-des-jeunes,mauvais-traitements-infliges-à-des-animaux]');
            $this->form_validation->set_rules('contenu-abusif-ou-incitant-a-la-haine', 'Contenua a caractere sexuel', 'in_list[apologie-de-la-haine-ou-de-la-violence,abus-sur-des-personnes-vulérables,description-ou-titre-inappropriees]');
            $this->form_validation->set_rules('harcelement-ou-intimidation', 'Contenua a caractere sexuel', 'in_list[harcelement-a mon-egard,harcelement-a-legard-dun-autre-personne]');
            $this->form_validation->set_rules('actes-dangereux-ou-pernicieux', 'Contenua a caractere sexuel', 'in_list[consommation-de-drogues-ou-de-produits-pharmaceutiques,utilisation-abusive-du-feu-ou-dexplosifs,suicide-ou-automutilation,autres-actes-dangereux]');
            $this->form_validation->set_rules('spam-ou-contenu-trompeur', 'Contenua a caractere sexuel', 'in_list[publicité-de-masse,vente-de-produits-pharmaceutiques,texte-mensonger,miniature-pouvant-preter-a-confusion,escroquerie-ou-fraude]');
            $this->form_validation->set_rules('non-respect-de-mes-droits', 'Contenua a caractere sexuel', 'in_list[probleme-lie-aux-droits-dauteur,probleme-de-confidentialité,atteinte-a-une-marque,diffamation,contrefaçon,autre-probleme-dordre-juridique]');
            $this->form_validation->set_rules('probleme-relatif-aux-sous-titres', 'Contenua a caractere sexuel', 'in_list[sous-titres-manquants-CVAA,sous-titres-inexacts,sous-titres-inappropries]');

            if ($this->form_validation->run() == true) {
                $radiosiganler = htmlspecialchars($this->input->post('RadioSiganler'));
                $raison_detail = '';
                $specificSelects = ['Contenuacaracteresexuel', 'contenu-violent-ou-abject', 'contenu-abusif-ou-incitant-a-la-haine', 'harcelement-ou-intimidation', 'actes-dangereux-ou-pernicieux', 'spam-ou-contenu-trompeur', 'non-respect-de-mes-droits', 'probleme-relatif-aux-sous-titres'];
                foreach ($specificSelects as $selectName) {
                    $selectValue = $this->input->post($selectName);
                    if (!empty($selectValue)) {
                        $raison_detail = $selectValue;
                        break;
                    }
                }

                $date_upload = date('Y-m-d H:i:s');
                $user_id = $this->session->userdata('id');
                $this->users_model->Signaler($user_id, $video_id, $radiosiganler, $raison_detail, $date_upload);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}
