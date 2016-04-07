<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $_data;



	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('Induction_model');
		//$this->output->enable_profiler(true);


	}

	/**
	 * Controller du tablea de bord.
	 *
	 *
	 */
	public function index(){

		if($this->user_model->isLoggedIn()){
			$this->load->library('layout');

			$this->_data['inductions'] = $this->Induction_model->get_induction_expire();
			$this->layout->view('dashboard',$this->_data);
			//var_dump($this->_data['inductions']);
		}else {
			$this->load->view('login',$this->_data);
		}


	}

}
