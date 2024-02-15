<?php
class Users_model extends CI_Model
{
    protected $tableName = 'users';
    /* ---------------------------------------------------------------------------------  */
    /* Funtion pour recuper tout les video avec les infomation de l'utilisateur de la bdd */
    /* ---------------------------------------------------------------------------------  */
    public function get_all_video()
    {
        $this->db->select('video.*, users.profile_image, users.pseudo, users.key_profile, users.id');
        $this->db->from('video');
        $this->db->join('users', 'users.id = video.user_id');
        $this->db->order_by('video.views_count', 'ESC'); // Ensuite, trie par nombre de vues de la plus élevée à la plus basse
        $query = $this->db->get();
        return $query->result_array();
    }
    /* ---------------------------------------------- */
    /* function pour savoir si lutilisateur et valide */
    /* ---------------------------------------------- */
    public function get_user_by_identifiant($identifiant, $mdp)
    {
        $query = $this->db->select('users.*, roles.role_name')
            ->where('(pseudo = "' . $identifiant . '" OR email = "' . $identifiant . '")')
            ->where('mdp', $mdp)
            ->from('users')
            ->join('roles', 'users.role_id = roles.role_id', 'left')
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    /* ------------------------------------------------------------  */
    /*                     Pour Créer un compte                      */
    /* ------------------------------------------------------------  */
    public function create_user($pseudo, $email, $mdp, $key_profile, $date_upload)
    {
        $data = array(
            'pseudo' => $pseudo,
            'email' => $email,
            'mdp' => $mdp,
            'key_profile' => $key_profile,
            'date' => $date_upload
        );

        $query = $this->db->insert('users', $data);
        return $query;
    }
    /* ------------------------------------------------------------  */
    /*       Pour update les infomation de l'utilisateur             */
    /* ------------------------------------------------------------  */

    public function update_user_data($data, $user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    /* ------------------------------------------------------------  */
    /*       Pour recuperé le role et l'image de la personne         */
    /* ------------------------------------------------------------  */
    public function get_user_profile($data)
    {
        $this->db->select('users.id, users.role_id, users.pseudo, users.profile_fond, roles.role_name');
        $this->db->from('users');
        $this->db->where($data);
        $this->db->join('roles', 'users.role_id = roles.role_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    /* ------------------------------------------------------------  */
    /* Pour savoir si l'email exists ou pas dans la basse de donnée  */
    /* ------------------------------------------------------------  */

    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function recup_mdp($token, $email)
    {
        $data = array(
            'recup_mdp' => $token,
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function is_valid($data)
    {
        $query = $this->db->get_where('users', $data);
        return $query->num_rows() == 1;
    }

    public function update_mdp_and_delete_token($mdp, $token)
    {
        $data = array(
            'mdp' => $mdp,
            'recup_mdp' => NULL
        );

        $this->db->where('recup_mdp', $token);
        $this->db->update('users', $data);
    }

    /* ------------------------------------------------------------  */
    /*                   Abonner ou non                              */
    /* ------------------------------------------------------------  */
    public function is_user_subscribed($Id)
    {
        $loggedInUserId = $this->session->userdata('id');

        if ($loggedInUserId) {
            $this->db->where('subscriber_id', $loggedInUserId);
            $this->db->where('subscribed_to_id', $Id);
            $query = $this->db->get('subscriptions');

            if ($query->num_rows() > 0) {
                return true; // L'utilisateur est abonné
            }
        }

        return false; // L'utilisateur n'est pas abonné
    }


    public function add_subscription($subscriberId, $subscribedToId)
    {
        $data = array(
            'subscriber_id' => $subscriberId,
            'subscribed_to_id' => $subscribedToId
        );

        // Insérer une nouvelle ligne dans la table `subscriptions`
        $this->db->insert('subscriptions', $data);
    }

    public function remove_subscription($subscriberId, $subscribedToId)
    {
        // Supprimer la ligne correspondante dans la table `subscriptions`
        $this->db->where('subscriber_id', $subscriberId);
        $this->db->where('subscribed_to_id', $subscribedToId);
        $this->db->delete('subscriptions');
    }

    public function get_subscription_count($userId)
    {
        $this->db->where('subscribed_to_id', $userId);
        $query = $this->db->get('subscriptions');

        return $query->num_rows();
    }

    /* ------------------------------------------------------------  */
    /*                   likes ou Dislike                            */
    /* ------------------------------------------------------------  */

    function getLikesCount($video_id)
    {
        return $this->db->where('item_id', $video_id)->where('type', 'like')->get('likes_dislikes')->num_rows();
    }

    function getDislikesCount($video_id)
    {
        return $this->db->where('item_id', $video_id)->where('type', 'dislike')->get('likes_dislikes')->num_rows();
    }

    function addLikeDislike($user_id, $video_id, $type)
    {
        // Vérifiez d'abord si l'utilisateur a déjà aimé ou n'a pas aimé la vidéo
        $existing_like_dislike = $this->db->get_where('likes_dislikes', array('user_id' => $user_id, 'item_id' => $video_id))->row_array();

        if ($existing_like_dislike) {
            // Si l'utilisateur a déjà aimé ou n'a pas aimé la vidéo, mettez à jour le type
            $this->db->where('id', $existing_like_dislike['id']);
            $this->db->update('likes_dislikes', array('type' => $type));
        } else {
            // Si l'utilisateur n'a pas encore aimé ou n'a pas aimé la vidéo, insérez un nouveau like/dislike
            $data = array(
                'user_id' => $user_id,
                'item_id' => $video_id,
                'type' => $type
            );
            $this->db->insert('likes_dislikes', $data);
        }
    }

    /* ------------------------------------------------------------ */
    /*           Likes ou Dislikes pour les commentaires            */
    /* ------------------------------------------------------------ */

    function getCommentLikesCount($comment_id)
    {
        return $this->db->where('item_id', $comment_id)->where('type', 'like')->get('likes_dislikes_commentaire')->num_rows();
    }

    function getCommentDislikesCount($comment_id)
    {
        return $this->db->where('item_id', $comment_id)->where('type', 'dislike')->get('likes_dislikes_commentaire')->num_rows();
    }

    function addCommentLikeDislike($user_id, $comment_id, $type)
    {
        $existing_like_dislike = $this->db->get_where('likes_dislikes_commentaire', array('user_id' => $user_id, 'item_id' => $comment_id))->row_array();

        if ($existing_like_dislike) {
            $this->db->where('id_com_likedislike', $existing_like_dislike['id_com_likedislike']);
            $this->db->update('likes_dislikes_commentaire', array('type' => $type));
        } else {
            $data = array(
                'user_id' => $user_id,
                'item_id' => $comment_id,
                'type' => $type
            );
            $this->db->insert('likes_dislikes_commentaire', $data);
        }
    }

    /* Stystem de vue sur les video   */
    public function increment_views($video_id)
    {
        $this->db->where('id_video', $video_id);
        $this->db->set('views_count', 'views_count + 1', FALSE);
        $this->db->update('video');
    }
    /* video poster  */
    public function get_video_info($data)
    {
        $this->db->select('video.*, users.profile_image, users.pseudo, users.key_profile, users.id');
        $this->db->from('video');
        $this->db->join('users', 'video.user_id = users.id', 'left');
        $this->db->where('video.video_lien', $data['video_lien']);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /* -------------------------------------------------------------------------------------------------  */
    /* Recuper les video similar de la video de base pour avoir les video de l'utilisateur qui a poster   */
    /* -------------------------------------------------------------------------------------------------  */
    public function get_similar_videos($user_id, $current_video_id, $limevideo)
    {
        $this->db->select('video.*, users.profile_image, users.pseudo, users.key_profile, users.id');
        $this->db->from('video');
        $this->db->join('users', 'video.user_id = users.id', 'left');
        $this->db->where('user_id', $user_id);
        $this->db->where('id_video !=', $current_video_id);
        $this->db->limit($limevideo);
        $this->db->order_by('RAND()');

        $query = $this->db->get();

        return $query->result_array();
    }

    /* ---------------------------------------------------- */
    /* Avoir des video random de tout les video dans la bdd */
    /* ---------------------------------------------------- */

    public function get_random_videos($current_user_id, $limit)
    {
        $this->db->select('video.*, users.profile_image, users.pseudo, users.key_profile, users.id');
        $this->db->from('video');
        $this->db->join('users', 'video.user_id = users.id', 'left');
        $this->db->where('video.user_id !=', $current_user_id); // Exclure les vidéos de l'utilisateur actuel
        $this->db->order_by('RAND()');
        $this->db->limit($limit);

        $query = $this->db->get();

        return $query->result_array();
    }

    /* ---------------------------------  */
    /* Pour upload une video sur le site  */
    /* ---------------------------------  */
    public function video_upload($video_path, $video_lien, $titre, $description, $date_upload, $video_bannier, $user_id)
    {
        $data = array(
            'video_path' => $video_path,
            'video_lien' => $video_lien,
            'titre' => $titre,
            'description' => $description,
            'date_upload' => $date_upload,
            'video_bannier' => $video_bannier,
            'user_id' => $user_id
        );

        $query = $this->db->insert('video', $data);
        return $query;
    }



    // pour sigaler des video 

    public function Signaler($user_id, $video_id, $radiosiganler, $raison_detail, $date_upload)
    {
        $data = array(
            'raison_detail' => $raison_detail,
            'raison' => $radiosiganler,
            'date_signale' => $date_upload,
            'id_video' => $video_id,
            'user_id' => $user_id
        );

        $query = $this->db->insert('video_signaler', $data);
        return $query;
    }

    /* pour commenter un video  */
    function add_commenter($commentTextarea, $user_id, $id_video, $date_upload)
    {
        $data = array(
            'commentaire' => $commentTextarea,
            'id_user' => $user_id,
            'id_video' => $id_video,
            'date_upload' => $date_upload,
        );

        $this->db->insert('video_commentaire', $data);

        // Récupérez l'ID du commentaire que vous venez d'insérer
        $comment_id = $this->db->insert_id();

        return $comment_id; // Retournez l'ID du commentaire
    }

    function getCommenterCount($video_id)
    {
        return $this->db->where('id_video', $video_id)
            ->get('video_commentaire')
            ->num_rows();
    }
    public function get_commentaires_videos($video_id)
    {
        $this->db->select('video_commentaire.*, users.profile_image, users.pseudo, users.key_profile, users.id');
        $this->db->from('video_commentaire');
        $this->db->join('users', 'video_commentaire.id_user = users.id');
        $this->db->where('video_commentaire.id_video', $video_id);
        $query = $this->db->get();
        return $query->result_array();
    }



    /* Admin panel */
    public function getUsersChartData($Salec1, $Salec2)
    {
        $this->db->select("DATE($Salec1) as date, COUNT(*) as nombre_$Salec2");
        $this->db->from($Salec2);
        $this->db->group_by("DATE($Salec1)");
        $query = $this->db->get();

        return $query->result();
    }

    public function getTotalUsers($Selec1)
    {
        $query = $this->db->query('SELECT COUNT(*) as total_users FROM ' . $Selec1);
        $result = $query->row();
        return $result->total_users;
    }
    public function getAllUsersData($Selec1)
    {
        $this->db->select('users.id, users.pseudo, users.email, users.role_id, users.date, roles.role_id, roles.role_name');
        $this->db->from($Selec1);
        $this->db->join('roles', 'users.role_id = roles.role_id', 'left');
        $query = $this->db->get();

        return $query->result();
    }
    public function getAllRoles()
    {
        $query = $this->db->get('roles');
        return $query->result();
    }

    public function updateUserRole($userId, $roleId)
    {
        $data = array('role_id' => $roleId);
        $this->db->where('id', $userId);
        $this->db->update('users', $data);

        return ($this->db->affected_rows() > 0);
    }

    public function getAllSiganle()
    {
        $this->db->select('video_signaler.*, video.titre AS video_titre, video.video_lien AS video_lien');
        $this->db->from('video_signaler');
        $this->db->join('video', 'video_signaler.id_video = video.id_video', 'left');
        $query = $this->db->get();
        return $query->result();
    }
}
