<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}
	/* 	----------------------------  */
	/* 	Login et debut de la session  */
	/* 	----------------------------  */
	public function login()
	{
		if (IsConnected()) {
			redirect('Media');
		}

		$this->form_validation->set_rules('identifiant', 'Identifiant', 'trim|required');
		$this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$identifiant = htmlspecialchars($this->input->post('identifiant'));
			$mdp = md5(md5($this->input->post('mdp')));

			$user_data = $this->users_model->get_user_by_identifiant($identifiant, $mdp);
			if ($user_data) {
				$session_user = [
					'id' => $user_data['id'],
					'pseudo' => $user_data['pseudo'],
					'email' => $user_data['email'],
					'role_name' => $user_data['role_name'],
					'key_profile' => $user_data['key_profile'],
					'profile_image' => $user_data['profile_image'],
					'profile_fond' => $user_data['profile_fond'],
					'description' => $user_data['description']
				];
				$this->session->set_userdata($session_user);
				redirect('Media');
			}
		}
		$this->layout->set_titre('SpaziaTube | Login');
		$this->layout->view('espace_user/login');
	}

	/* --------------------------------------------  */
	/*         Pour Inscription des user             */
	/* --------------------------------------------  */
	public function inscription()
	{
		if (IsConnected() == true) {
			redirect('Media');
		} else {
			$this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|required|min_length[5]|max_length[30]|is_unique[users.pseudo]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('mdp_confirm', 'Confirmation du mot de passe', 'trim|required|matches[mdp]');

			if ($this->form_validation->run() == TRUE) {

				$pseudo = htmlspecialchars($this->input->post('pseudo'));
				$email = htmlspecialchars($this->input->post('email'));
				$mdp = md5(md5($this->input->post('mdp')));
				$key_profile = bin2hex(random_bytes(10));
				$date_upload = date('Y-m-d H:i:s');

				$result = $this->users_model->create_user($pseudo, $email, $mdp, $key_profile, $date_upload);

				if ($result) {
					redirect('/Users/login');
				} else {
					redirect('/Users/inscription');
				}
			} else {
				$this->layout->set_titre('SpaziaTube | Inscription');
				$this->layout->view('espace_user/inscription');
			}
		}
	}

	/* --------------------------------------------  */
	/*    Pour destroy la session (deconnect)        */
	/* --------------------------------------------  */
	public function deconnect()
	{
		session_destroy();
		redirect('Media');
	}
	/* -------------------------------------------  */
	/*         Pour recuper le mdp perdue           */
	/* -------------------------------------------  */
	public function recup_mdp()
	{
		$this->layout->set_titre('SpaziaTube | Recup Mot de passe');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		$email = htmlspecialchars($this->input->post('email'));

		if ($this->form_validation->run() == FALSE) {
			$this->layout->view('espace_user/recup_mdp');
		} else {
			if ($this->users_model->email_exists($email)) {

				$token = bin2hex(random_bytes(30));
				$this->users_model->recup_mdp($token, $email);
				$lien = anchor('Users/changer_mdp/' . $token, 'Cliquez ici pour réinitialiser votre mot de passe');

				/* ---------------------------------------------------------- */
				/* Config pour charger le ficher email qu'il à dans config    */
				/* ---------------------------------------------------------- */

				$this->load->config('email');
				$from = $this->config->item('smtp_user');

				$this->email->from($from, 'Spaziatube | Mot de passe Oublié !');
				$this->email->to($email);
				$this->email->subject('Mot de passe Oublié !');
				$this->email->message('Le lien de votre mot de passe oublié ' . $lien);

				if ($this->email->send()) {
					$data['mail_good'] = 'good';
					$this->layout->view('espace_user/recup_mdp', $data);
				} else {
					$data['mail_error'] = 'error';
					$this->layout->view('espace_user/recup_mdp', $data);
					echo 'Echec de l\'envoi de l\'e-mail : ' . $this->email->print_debugger();
				}
			} else {

				$data['info_connexion'] = 'error';
				$this->layout->view('espace_user/recup_mdp', $data);
			}
		}
	}

	public function changer_mdp($token = '')
	{
		$data = array(
			'recup_mdp' => $token
		);
		if ($this->users_model->is_valid($data)) {


			$this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('mdp_confirm', 'Confirmation du mot de passe', 'trim|required|matches[mdp]');

			if ($this->form_validation->run() == TRUE) {

				$mdp = md5(md5($this->input->post('mdp')));
				$result = htmlspecialchars($this->users_model->update_mdp_and_delete_token($mdp, $token));

				if ($result) {
					echo 'Erreur lors de la mise à jour du mot de passe';
				} else {
					$data['info_mdp'] = 'good';
					$this->layout->view('espace_user/changer_mdp', $data);
					header("refresh:5;url=" . base_url() . "Users/");
				}
			} else {
				$this->layout->set_titre('SpaziaTube | Changer Mot de passe');
				$this->layout->view('espace_user/changer_mdp');
			}
		} else {
			redirect('Media');
		}
	}

	/* --------------------------------------- */
	/* Pour avoir le mode dark/light avec btn  */
	/* --------------------------------------- */

	public function setMode($mode)
	{
		$this->session->set_userdata('mode', $mode);

		redirect($_SERVER['HTTP_REFERER']);
	}

	/* -------------------------------------------------- */
	/* Settings des utilisateur Modification de img/font  */
	/* -------------------------------------------------- */
	public function Settings()
	{
		$this->layout->set_titre('SpaziaTube | Settings');
		if (IsConnected() == false) {
			redirect('Media');
		} else {
			if (!empty($_POST['pseudo'])) {
				$this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|min_length[5]|max_length[30]|is_unique[users.pseudo]');
			}

			if (!empty($_POST['email'])) {
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]');
			}

			if (!empty($_POST['mdp'])) {
				$this->form_validation->set_rules('mdp', 'Mot de passe', 'min_length[8]');
				$this->form_validation->set_rules('mdp_confirm', 'Confirmation du mot de passe', 'matches[mdp]');
			}

			if (!empty($_POST['description'])) {
				$this->form_validation->set_rules('description', 'Description', 'trim');
			}

			if (!empty($_FILES['profile_fond']['name'])) {
				$this->form_validation->set_rules('profile_fond', 'Image de fond');
			}

			if (!empty($_FILES['profile_image']['name'])) {
				$this->form_validation->set_rules('profile_image', 'Image de profil');
			}

			if ($this->form_validation->run() == true) {

				$user_id = $this->session->userdata('id');

				if (!empty($this->input->post('pseudo'))) {
					$data['pseudo'] = htmlspecialchars($this->input->post('pseudo'));
					$this->session->set_userdata('pseudo', $data['pseudo']);
				}

				if (!empty($this->input->post('email'))) {
					$data['email'] = htmlspecialchars($this->input->post('email'));
					$this->session->set_userdata('email', $data['email']);
				}

				if (!empty($this->input->post('mdp'))) {
					$data['mdp'] = md5(md5($this->input->post('mdp'))); // Assurez-vous de sécuriser le mot de passe correctement.
				}

				if (!empty($this->input->post('description'))) {
					$data['description'] = htmlspecialchars($this->input->post('description'));
					$this->session->set_userdata('description', $data['description']);
				}

				if (!empty($_FILES['profile_fond']['name'])) {
					$upload_path = './uploads/profile/' . $user_id . '/fond/';
					$new_file_name = $this->upload_image('profile_fond', $upload_path);
					if ($new_file_name) {
						$data['profile_fond'] = $new_file_name;
					}
				}

				// Gérer le téléchargement de l'image de profil
				if (!empty($_FILES['profile_image']['name'])) {
					$upload_path = './uploads/profile/' . $user_id . '/';
					$new_file_name = $this->upload_image('profile_image', $upload_path);
					if ($new_file_name) {
						$data['profile_image'] = $new_file_name;
					}
				}

				$this->users_model->update_user_data($data, $user_id);
				redirect('Users/Settings');
			} else {
				$data['upload_error_profile'] = $this->session->flashdata('upload_error_profile');
				$data['upload_error_fond'] = $this->session->flashdata('upload_error_fond');

				if (!empty($data['upload_error_profile'] || $data['upload_error_fond'])) {
					$this->layout->view('espace_user/settings', $data);
				} else {
					$this->layout->view('espace_user/settings');
				}
			}
		}
	}

	public function upload_image($field_name = '', $upload_path = '')
	{

		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, true);


			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 30720;
			$config['overwrite'] = true;

			// Charger la bibliothèque d'upload
			$this->load->library('upload', $config);

			// Vérifier si l'upload a réussi
			if ($this->upload->do_upload($field_name)) {
				// L'upload a réussi, récupérer les informations sur l'image
				$upload_data = $this->upload->data();

				$pseudo = $this->session->userdata('pseudo');
				$extension = $upload_data['file_ext'];

				// Calculer la somme de hachage SHA-1 du contenu de l'image
				$file_path = $upload_data['full_path'];
				$hash = sha1_file($file_path);

				// Générer un nom unique en utilisant le pseudo, le hachage et l'extension
				$image_nom = $pseudo . '_' . $hash . $extension;

				$profile_image = $this->session->userdata($field_name);

				// Vérifier si l'image actuelle est différente de l'image par défaut
				if ($profile_image && $profile_image != 'defauft.png' && $profile_image != 'defauft_fond.png') {
					// Supprimer l'ancienne image du dossier "uploads"
					$old_file_path = $upload_path . '/' . $profile_image;
					unlink($old_file_path);
				}

				// Renommer le fichier téléchargé avec le nouveau nom
				$new_file_path = $config['upload_path'] . $image_nom;
				rename($file_path, $new_file_path);
				$this->session->set_userdata($field_name, $image_nom);

				return $image_nom;
			} else {
				$error = $this->upload->display_errors();
				if ($field_name == 'profile_image') {
					$this->session->set_flashdata('upload_error_profile', $error);
				} else {
					$this->session->set_flashdata('upload_error_fond', $error);
				}
				redirect('Users/Settings');
			}
		} else {

			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 30720;
			$config['overwrite'] = true;

			// Charger la bibliothèque d'upload
			$this->load->library('upload', $config);

			// Vérifier si l'upload a réussi
			if ($this->upload->do_upload($field_name)) {
				// L'upload a réussi, récupérer les informations sur l'image
				$upload_data = $this->upload->data();

				$pseudo = $this->session->userdata('pseudo');
				$extension = $upload_data['file_ext'];

				// Calculer la somme de hachage SHA-1 du contenu de l'image
				$file_path = $upload_data['full_path'];
				$hash = sha1_file($file_path);

				// Générer un nom unique en utilisant le pseudo, le hachage et l'extension
				$image_nom = $pseudo . '_' . $hash . $extension;

				$profile_image = $this->session->userdata($field_name);

				// Vérifier si l'image actuelle est différente de l'image par défaut
				if ($profile_image && $profile_image != 'defauft.png' && $profile_image != 'defauft_fond.png') {
					// Supprimer l'ancienne image du dossier "uploads"
					$old_file_path = $upload_path . '/' . $profile_image;
					unlink($old_file_path);
				}

				// Renommer le fichier téléchargé avec le nouveau nom
				$new_file_path = $config['upload_path'] . $image_nom;
				rename($file_path, $new_file_path);
				$this->session->set_userdata($field_name, $image_nom);

				return $image_nom;
			} else {
				$error = $this->upload->display_errors();
				if ($field_name == 'profile_image') {
					$this->session->set_flashdata('upload_error_profile', $error);
				} else {
					$this->session->set_flashdata('upload_error_fond', $error);
				}

				redirect('Users/Settings');
			}
		}
	}

	function ConditionsUtilisation()
	{
		$this->layout->view('conditions/conditions-utilisation');
	}
	function ReglementCommunaute()
	{
		$this->layout->view('conditions/reglement-de-la-communaute');
	}
}
