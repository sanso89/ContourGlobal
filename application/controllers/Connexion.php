<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller {

	private $_data = array( 'titre'=>'ContourGlobal',
	  						'css'=>array(),
	  						'js'=>array());



	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->_data['titre'] ='ContourGlobal';
		$this->_data['css'] = array();
		$this->_data['js'] = array();
		//$this->output->enable_profiler(true);



	}

	/**
	 * Index du controlleur connexion
	 * function qui s'execute par defaut
	 *
	 */


	public function index(){
		if($this->user_model->isLoggedIn()){
			redirect('dashboard');
		}else {
			$this->load->view('login',$this->_data);
		}


	}


	/*
	|===============================================================================
	| Méthodes pour modifier les variables envoyées au layout
	| . set_titre
	| . set_charset
	|===============================================================================
	*/
	public function set_titre($titre){
		if(is_string($titre) AND !empty($titre)){
			$this->data['titre'] = $titre;
			return true;
		}
		return false;
	}

	public function set_charset($charset){
		if(is_string($charset) AND !empty($charset)){
			$this->data['charset'] = $charset;
			return true;
		}
		return false;
	}

	public function login(){

		if($this->user_model->isLoggedIn()){
			redirect('dashboard');
		}else {
			#definition des règle de succès
			$this->form_validation->set_rules('login','Login','trim|required');
			$this->form_validation->set_rules('password','Mot de passe','trim|required');
			if($this->form_validation->run() == FALSE){
				$this->load->view('login',$this->_data);
			}else {
				$username=$this->input->post('login');
				$password=$this->input->post('password');
				$valide_log = $this->user_model->validLogin($this->encrypt->encode($username),$this->encrypt->encode($password));
				if($valide_log){
					#Ici on recupere les droits et taxes

					redirect('dashboard');
				}else{
					$this->_data['error_authentification'] = 'Login / Mot de passe incorrect';
          $this->load->view('login',$this->_data);
				}
			}
		}
	}


	public function deconnexion(){
	     if($this->user_model->isLoggedIn()){
	     	$this->session->sess_destroy();
	         $this->load->view('login',$this->_data);
	     }else {
	     	 $this->load->view('login',$this->_data);
	     }
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
