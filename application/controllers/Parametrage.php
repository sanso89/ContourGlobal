<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parametrage extends CI_Controller {

	private $_data = array( 'titre'=>'',
	  						'css'=>array(),
	  						'js'=>array());



	public function __construct(){
		parent::__construct();
		$this->load->helper('assets_helper');
		$this->load->model('parametre_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		if($this->user_model->isLoggedIn()){
			$this->load->library('Layout');
		}else {
			redirect('connexion');
		}
	}


/**
* Debut fonctions pour la gestion des utilisateurs
*
*/
	public function user_manager(){
		$this->_data['profils'] = $this->user_model->select_all_profil();
		$this->_data['users'] = $this->user_model->select_all_user();
		$this->layout->view('parametrage/user_manager_form',$this->_data);
}


	public function get_user_info($primary_key){
		$result_data=$this->user_model->select_user($primary_key);
			$data = array(
						'id_user'=>$result_data[0]->ID_USER,
						'last_name'=>$result_data[0]->LAST_NAME,
						'first_name'=>$result_data[0]->FIRST_NAME,
						'email'=>$result_data[0]->EMAIL,
						'login'=>$result_data[0]->LOGIN,
						'password'=>"",
						'confirm_password'=>"",
						'id_profil'=>$result_data[0]->ID_ROLE,
						'profil'=>$result_data[0]->ROLE_NAME
						);
		return $data;
	}


	public function update_user($primary_key){
		$data=$this->get_user_info($primary_key);
		$this->_data=array_merge($this->_data,$data);
		$this->user_manager();
	}



	public function delete_user($primary_key){
		if($this->user_model->delete_user($primary_key)){
			$this->_data['message_suppression']='Ligne supprimée';
		}
		$this->user_manager();

	}




	public function register_user(){
		$this->form_validation->set_rules('last_name','Nom','trim|required');
	    $this->form_validation->set_rules('first_name','Prénom','trim|required');
	    $this->form_validation->set_rules('email','Email','trim');
	    $this->form_validation->set_rules('login','Login','trim|required');
	    $this->form_validation->set_rules('password','password','trim|required');
	    $this->form_validation->set_rules('confirm_password','Comfir password','trim|required');
	    $this->form_validation->set_rules('profil','Profil','trim|required');
		if($this->user_model->isLoggedIn()){
			if ($this->form_validation->run() == FALSE){
				$this->layout->view('parametrage/user_manager_form',$this->_data);
			}else{
				$data = array(
							'id_user'=>strtoupper($this->input->post('id_user')),
							'last_name'=>strtoupper($this->input->post('last_name')),
							'first_name'=>ucfirst($this->input->post('first_name')),
							'email'=>($this->input->post('email')),
							'login'=>strtoupper($this->input->post('login')),
							'password'=>($this->input->post('password')),
							'confirm_password'=>($this->input->post('confirm_password')),
							'profil'=>($this->input->post('profil'))
						);
				$this->_data=array_merge($this->_data,$data);
				if($this->input->post('id_user')==""){
					$valide_insert = $this->user_model->create_user($data);
					$this->_data['valide_insert_ok']= 'Insertion effectuée avec succès';
				}else{
					#on fait plutot une modification des données
					$valide_insert = $this->user_model->update_user($data,$this->input->post('id_user'));
					$this->_data['valide_insert_ok']= 'Modification effectuée avec succès';
				}
				if($valide_insert){
					$this->_data['id_user']= '';
					$this->_data['last_name']= '';
					$this->_data['first_name']= '';
					$this->_data['email']= '';
					$this->_data['login']= '';
					$this->_data['password']= '';
					$this->_data['confirm_password']= '';
					$this->_data['profil']= '';


				}else{
					$this->_data['valide_insert_echec']= 'Echec de l\'insertion ';

				}
				$this->_data['profils'] = $this->user_model->select_all_profil();
				$this->_data['users'] = $this->user_model->select_all_user();
				$this->layout->view('parametrage/user_manager_form',$this->_data);
			}

		}else {
			$this->load->view('login',$this->_data);
		}

	}



	/*
	*Fonction qui permet de controler si un login est déja enregistrer
	*/
	public function verification_login(){
		$login =(trim($_POST['login']));
		$resultat=$this->user_model->select_colonne_user($login,'login');
		//var_dump($resultat);
		if(is_array($resultat) && count($resultat)!=0){
			 if($resultat[0]->LOGIN!=""){
				echo json_encode($resultat[0]->LOGIN);
			}else{
				echo json_encode(null);
			}
		}else {
			echo json_encode(null);
		}




	}




}
