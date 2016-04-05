<?php
if (!defined('BASEPATH')) exit('No direct srcipt access allowed');

class Induction_model extends CI_Model{

	private $_table_induction='induction';
	private $_id_induction='id';
	private $_date_enreg='date_enreg';
	private $_code_societe='code_societe';

	private $_nom_societe='nom_societe';
	private $_nom_contractant='nom_contractant';
	private $_prenom_contractant='prenom_contractant';

	private $_date_naissance='date_naissance';
	private $_dure='dure';
	private $_date_induction='date_induction';
	private $_date_expiration='date_expiration';

	private $_table_society = "societe";
	private $_id_societe = "id_societe";


	/*CHAMPS COMMUN A TOUTES LES TABLES*/
	private $_valid = 'valid';
	private $_history = 'HISTORY';
	private $_modify_id = 'MODIFY_ID';
	private $_modify_date = 'MODIFY_TIME';
	private $_create_id = 'CREATE_ID';
	private $_create_date = 'CREATE_DATE';

	public function __construct(){
		parent::__construct();
	}



	/**
	* Pour avoir la liste de toutes les societes
	*
	*/
	function get_all_societe(){
		return $this->db->select($this->_code_societe)
					->select($this->_nom_societe)
					->select($this->_id_societe)
					->from($this->_table_society)
					->order_by($this->_nom_societe)
					->get()
					->result();
	}


	/**
	* Pour avoir la liste de tous les inductions
	*
	*/
	function get_all_induction($societe=""){
		//var_dump($societe);
					$this->db->select('*');
					$this->db->from($this->_table_induction);
					$this->db->join($this->_table_society,$this->_table_society.'.'.$this->_id_societe.'='.$this->_table_induction.'.'.$this->_code_societe,'left');
					if(isset($societe) && $societe!=""){
						$this->db->where($this->_table_induction.'.'.$this->_code_societe,$societe);
					}
					$this->db->where($this->_table_induction.'.'.$this->_valid,'O');
					return $this->db->get()->result();
	}

	function get_info_induction($id_induction){
		$this->db->select('*,'.$this->_table_society.'.'.$this->_nom_societe.' as societe');
		$this->db->from($this->_table_induction);
		$this->db->join($this->_table_society,$this->_table_society.'.'.$this->_id_societe.'='.$this->_table_induction.'.'.$this->_code_societe,'left');
		$this->db->where($this->_table_induction.'.'.$this->_valid,'O');
		$this->db->where($this->_table_induction.'.'.$this->_id_induction,$id_induction);
		return $this->db->get()->result();
	}

	/**
	*
	* Pour enregistrer une nouvelle induction
	*/
	function create_induction($data){
		$this->db->set($this->_date_enreg,$data['date_enreg']);
		$this->db->set($this->_code_societe,$data['code_societe']);
		$this->db->set($this->_nom_societe,$data['nom_societe']);
		$this->db->set($this->_nom_contractant,$data['nom_contractant']);
		$this->db->set($this->_prenom_contractant,$data['prenom_contractant']);
		$this->db->set($this->_date_naissance,$data['date_naissance']);
		$this->db->set($this->_date_induction,$data['date_induction']);
		$this->db->set($this->_date_expiration,$data['date_expiration']);
		if($this->db->insert($this->_table_induction)){
			return true;
		}else {
			return false;
		}
	}


	/**
	*
	*Pour la lmodification d'une induction
	*/
	function update_induction($data,$id_induction){
		$this->db->set($this->_date_enreg,$data['date_enreg']);
		$this->db->set($this->_code_societe,$data['code_societe']);
		$this->db->set($this->_nom_societe,$data['nom_societe']);
		$this->db->set($this->_nom_contractant,$data['nom_contractant']);
		$this->db->set($this->_prenom_contractant,$data['prenom_contractant']);
		$this->db->set($this->_date_naissance,$data['date_naissance']);
		$this->db->set($this->_date_induction,$data['date_induction']);
		$this->db->set($this->_date_expiration,$data['date_expiration']);
		$this->db->where($this->_id_induction,$id_induction);
		if($this->db->update($this->_table_induction)){
			return true;
		}else {
			return false;
		}
	}

	/**
	*
	*Pour ajouter une societe dans la base
	*/
	function add_society($nom_societe){
		$this->db->select($this->_nom_societe);
		$this->db->from($this->_table_society);
		$this->db->where($this->_nom_societe,$nom_societe);
		$result = $this->db->count_all_results();
		//var_dump ($result);
		if($result == 0){
			$this->db->set($this->_nom_societe,$nom_societe);
			if($this->db->insert($this->_table_society)){
				return $nom_societe;
			}else {
				return false;
			}
		}else{
			return false;
		}

	}

	/**
	* Pour supprimer une induction
	*
	*/
	function delete_induction($id){
		if($id != null){
				$data=array(
					$this->_valid=>'N'
					);
			$this->db->where($this->_id_induction, (int) $id);
			return $this->db->update($this->_table_induction,$data);
		}
	}



}


?>
