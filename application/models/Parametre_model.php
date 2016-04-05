<?php
if (!defined('BASEPATH')) exit('No direct srcipt access allowed');

class Parametre_model extends CI_Model{
	
	private $_table_declarant='declarant';
	private $_code_declarant='DEC_COD';
	private $_nom_declarant='DEC_NAM';

	private $_table_importateur='importateur';
	private $_code_importateur='CMP_COD';
	private $_nom_importateur='CMP_NAM';

	private $_table_marchandise='marchandise';
	private $_nts='HS6_COD';
	private $_nts_precision1='TAR_PR1';
	private $_nts_precision2='TAR_PR2';
	private $_nts_precision3='TAR_PR3';
	private $_nts_description='TAR_DSC';
	private $_nts_description1='TAR_ALL';

	private $_table_colis= "type_colis";
	private $_pkg_cod = "PKG_COD";
	private $_pkg_dsc = "PKG_DSC";

	private $_table_declaration_importe='zf_declaration_sydonia';
	private $id_dec='ID';
	private $_instanceid='INSTANCEID';
	private $_date_enreg_dec='IDE_REG_DAT';
	private $_type_dec='IDE_TYP_SAD'; //exemple IM
	private $_proc_gen='IDE_TYP_PRC'; //exemple 4 
	private $_serie_enrgistrement='IDE_REG_SER'; //exemple IM
	private $_nombre_enregistrement='IDE_REG_NBR'; //exemple 4 
	
	/*CHAMPS COMMUN A TOUTES LES TABLES*/
	private $_valid = 'VALID';
	private $_history = 'HISTORY';
	private $_modify_id = 'MODIFY_ID';
	private $_modify_date = 'MODIFY_TIME';
	private $_create_id = 'CREATE_ID';
	private $_create_date = 'CREATE_DATE';

	public function __construct(){
		parent::__construct();
	}


	
	/**
	* Pour avoir la liste de tous les déclarants
	*
	*/
	function get_all_declarant($code){
		return $this->db->select($this->_code_declarant)
					->select($this->_nom_declarant)
					->from($this->_table_declarant)
					->like($this->_code_declarant,$code)
					->limit(30, 0)
					->get()
					->result();
	}
	

	/**
	* Pour avoir la liste de tous les déclarants
	*
	*/
	function get_all_importateur($code){
		return $this->db->select($this->_code_importateur)
					->select($this->_nom_importateur)
					->from($this->_table_importateur)
					->like($this->_code_importateur,$code)
					->limit(30, 0)
					->get()
					->result();
	}

	
	


	/**
	* Pour avoir la liste de tous les déclarants
	*
	*/
	function get_all_marchandise($code){
		return $this->db->select($this->_nts)
					->select($this->_nts_precision1)
					->select($this->_nts_precision2)
					->select($this->_nts_precision3)
					->select($this->_nts_description)
					->select($this->_nts_description1)
					->from($this->_table_marchandise)
					->like('CONCAT('.$this->_nts.','.$this->_nts_precision1.','.$this->_nts_precision2.')',$code,'after')
					//->like($this->_nts.' || '.$this->_nts_precision1.' || '.$this->_nts_precision2,$code,'after')
					->limit(30, 0)
					->get()
					->result();
	}
	
	
	/**
	* Avoir la liste des type de colis
	*
	*/
	function select_all_type_colis(){
		return $this->db->select('*')
					->from($this->_table_colis)
					->order_by($this->_pkg_dsc)
					->get()
					->result();
	}


}


?>