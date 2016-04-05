<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url')){
	function css_url($nom){
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url')){
	function js_url($nom){
		return base_url() . 'assets/javascript/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url')){
	function img_url($nom){
		return base_url() . 'assets/images/' . $nom;
	}
}

if ( ! function_exists('img')){
	function img($nom, $alt = ''){
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}



if ( ! function_exists('convertion_date')){
	 function convertion_date($date,$type_source="fr",$type_finale="en"){
		
		if($date!=""){
			if($type_source=="fr"){
			$tableau_date=explode("/", $date);
			$separator="-";
			if ($tableau_date[0]=="0000") {
				$date_return="";
			}else {
				$date_return=$tableau_date[2].$separator.$tableau_date[1].$separator.$tableau_date[0];
			}

		}else if($type_source=="en"){
			$tableau_date=explode("-", $date);
			$separator="/";
			if ($tableau_date[2]=="0000") {
				$date_return="";
			}else {
				$date_return=$tableau_date[2].$separator.$tableau_date[1].$separator.$tableau_date[0];
			}
		}
		return $date_return;
	}else {
		return "";
	}
	}
}

?>