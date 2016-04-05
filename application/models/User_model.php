<?php
if (!defined('BASEPATH')) exit('No direct srcipt access allowed');
class User_model extends CI_Model{

	private $_table_profil = 'profil';
	private $_id_role = 'ID_ROLE';
	private $_role_name = 'ROLE_NAME';
	private $_permission = 'PERMISSION';

	private $_table_user = 'user';
	private $_id_user = 'ID_USER';
	private $_nom = 'LAST_NAME';
	private $_prenom = 'FIRST_NAME';
	private $_email = 'EMAIL';
	private $_login = 'LOGIN';
	private $_password = 'PASSWORD';
	private $_verrou ='LOCKFLAG';
	private $_profil ='ID_ROLE';

	private $_valid = 'VALID';
	private $_history = 'HISTORY';
	private $_modify_id = 'MODIFY_ID';
	private $_modify_date = 'MODIFY_TIME';
	private $_create_id = 'CREATE_ID';
	private $_create_date = 'CREATE_DATE';


	public function __construct(){
		parent::__construct();
		$this->load->library('encrypt');
	}


	function validLogin($username,$password){
		#requete prepareé
		$req="SELECT ".$this->_id_user.",".$this->_login.",".$this->_nom.",".$this->_prenom;
		$req.=",".$this->_email.",".$this->_permission.",".$this->_role_name;
		$req.=" FROM ".$this->_table_user." INNER JOIN ".$this->_table_profil." ON ".$this->_table_user.".".$this->_profil."=".$this->_table_profil.".".$this->_id_role;
		$req.=" WHERE ".$this->_login."=? AND ".$this->_password."=sha1(?) AND ".$this->_table_profil.".".$this->_valid."='O'";
		$data = array($this->encrypt->decode($username),$this->encrypt->decode($password));
		$req=$this->db->query($req,$data);
		if($req->num_rows()>0){
			$resultat=$req->result();
			$session_data = array(
								  'id_user' => $resultat[0]->ID_USER,
								  'Login' => $resultat[0]->LOGIN,
								  'last_name' => $resultat[0]->LAST_NAME,
								  'first_name' => $resultat[0]->FIRST_NAME,
								  'email' => $resultat[0]->EMAIL,
								  'permission' => $resultat[0]->PERMISSION,
								  'profil' => $resultat[0]->ROLE_NAME,
								  'logged_in'=>TRUE,
								  );
			$this->session->set_userdata($session_data);
			return true;
		}else {
			return false;
		}

	}

	function isLoggedIn(){
		if($this->session->userdata('logged_in')){
			return true;
		}else return false;
	}



	function select_all_profil(){
		return $this->db->select('*')
					->from($this->_table_profil)
					->order_by($this->_role_name)
					->get()
					->result();
	}

	function select_all_user(){
		return $this->db->select('*')
					->from($this->_table_user)
					->join($this->_table_profil,$this->_table_user.".".$this->_profil."=".$this->_table_profil.".".$this->_id_role)
					->where($this->_table_user.'.'.$this->_valid, 'O')
					->order_by($this->_nom)
					->get()
					->result();
	}

	function create_user($data){
		$this->db->set($this->_nom,$data['last_name']);
		$this->db->set($this->_prenom,$data['first_name']);
		$this->db->set($this->_email,$data['email']);
		$this->db->set($this->_login,$data['login']);
		$this->db->set($this->_profil,$data['profil']);
		$this->db->set($this->_password,sha1($data['password']));
		$this->db->set($this->_history,'creer le '.date("d-m-Y").' par '.' '.$this->session->userdata('last_name').' '.$this->session->userdata('first_name'));
		$this->db->set($this->_create_id,$this->session->userdata('id_user'));
		$this->db->set($this->_create_date,date("Y-m-d"),false);

		if($this->db->insert($this->_table_user)){
			return true;
		}
	}

	function update_user($data,$id_user){
		$result=$this->db->select($this->_history)
											->select($this->_password)
											->from($this->_table_user)
											->where($this->_valid, 'O')
											->where($this->_id_user, (int)$id_user)
											->get()
											->result();
								
		$history=$result[0]->HISTORY;
		$password=$result[0]->PASSWORD;


		$this->db->set($this->_nom,$data['last_name']);
		$this->db->set($this->_prenom,$data['first_name']);
		$this->db->set($this->_email,$data['email']);
		$this->db->set($this->_login,$data['login']);
		$this->db->set($this->_password,sha1($data['password']));
		$this->db->set($this->_history,$history.' Modifié le '.date("d-m-Y H:i:s").' par '.' '.$this->session->userdata('last_name').' '.$this->session->userdata('first_name'));
		$this->db->set($this->_modify_id,$this->session->userdata('id_user'));
		$this->db->where($this->_id_user, (int) $id_user);
		return $this->db->update($this->_table_user);
	}

	function select_colonne_user($user_parametre,$champs){
		if($champs=="login"){
			$champs_recherche=$this->_login;
		}
		return $this->db->select($champs_recherche)
					->from($this->_table_user)
					->where($this->_login,$user_parametre)
					->get()
					->result();
	}



	function select_user($primary_key){
		if($primary_key!=""){
			return $this->db->select('*')
					->from($this->_table_user)
					->join($this->_table_profil,$this->_table_user.".".$this->_profil."=".$this->_table_profil.".".$this->_id_role)
					->where($this->_id_user,$primary_key)
					->get()
					->result();
		}

	}


	function delete_user($id_user){
		if($id_user != null){
		$result=$this->db->select($this->_history)
					->from($this->_table_user)
					->where($this->_valid, 'O')
					->where($this->_id_user, (int)$id_user)
					->get()
					->result();
		$history=$result[0]->HISTORY;
		$data=array(
					$this->_valid=>'N',
					$this->_history=>$history.' Modifié le '.date("d-m-Y H:i:s").' par '.' '.$this->session->userdata('last_name').' '.$this->session->userdata('first_name'),
					$this->_modify_id=>$this->session->userdata('id_user')
					);

			$this->db->where($this->_id_user, (int) $id_user);
			return $this->db->update($this->_table_user,$data);
		}
	}


}


?>
