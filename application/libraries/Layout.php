<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout
{
private $CI;
private $var = array();
private $theme = 'default_template'; #Thème par default
	/*
	|===============================================================================
	| Constructeur
	|===============================================================================
	*/
	public function __construct(){
		$this->CI = & get_instance();
		$this->var['content']='';
		#$this->var['titre'] = ucfirst($this->CI->router->fetch_method()) . '- ' . ucfirst($this->CI->router->fetch_class());
		$this->var['titre'] ='ContourGlobal';
		$this->var['charset'] = $this->CI->config->item('charset');
		$this->var['css'] = array();
		$this->var['js'] = array();
	}

	/*
	|===============================================================================
	| Méthodes pour charger les vues
	| . view
	| . views
	|===============================================================================
	*/
	public function view($name, $data = array()){
		$this->var['content'].=$this->CI->load->view($name,$data,true);
		//$this->CI->load->view('../template/'. $this->theme,$this->var);
		$this->CI->load->view('/template/default_template', $this->var);

	}


	public function views($name, $data = array()){
		$this->var['content'].=$this->CI->load->view($name,$data,true);
		return $this;
	}

/*
|===============================================================================
| Méthodes pour ajouter des feuilles de CSS et de JavaScript
| . ajouter_css
| . ajouter_js
|===============================================================================
*/
	public function ajouter_css($nom){
		if(is_string($nom) AND !empty($nom) AND file_exists('./assets/css/' . $nom .'.css')){
			$this->var['css'][] = css_url($nom);
			return true;
		}
		return false;
	}

	public function ajouter_js($nom){
		if(is_string($nom) AND !empty($nom) AND file_exists('./assets/js/' .$nom . '.js')){
			$this->var['js'][] = js_url($nom);
			return true;
		}
		return false;
	}


	#pour definir le thème à utilisé
	public function set_theme($theme){
		if(is_string($theme) AND !empty($theme) AND file_exists('./application/view/template/' . $theme . '.php')){
			$this->theme = $theme;
			return true;
		}
		return false;
	}


}
