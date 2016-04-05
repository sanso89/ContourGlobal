<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');
    class Induction extends CI_Controller{
      private $_data;

      public function __construct(){
        parent::__construct();
        $this->load->model('Induction_model');
        $this->load->library('Form_validation');
        $this->load->helper('assets_helper');


        $this->output->enable_profiler(true);
        $this->_data['societes'] = $this->Induction_model->get_all_societe();
      }

      //fonction pour afficher le formulaire d'enregistrement d'une nouvelle indiction
      public function new_induction(){
        if($this->user_model->isLoggedIn()){

    			$this->layout->view('induction/new_induction_form',$this->_data);
    		}else {
    			$this->load->view('login',$this->_data);
    		}
      }

      //fonction pour afficher la liste des inductions
      public function verify_induction(){
        if($this->user_model->isLoggedIn()){
          if(isset($_POST) && !empty($_POST)){
              $nom_societe = $this->input->post('code_societe');
              $this->_data['inductions'] = $this->Induction_model->get_all_induction($nom_societe);
          }else {
            $this->_data['inductions'] = $this->Induction_model->get_all_induction();
          }
    			$this->layout->view('induction/list_induction_form',$this->_data);
    		}else {
    			$this->load->view('login',$this->_data);
    		}
      }


      //function pour enrgistrer dans la base les inductions
      public function register_induction(){
        if($this->user_model->isLoggedIn()){
          $data  = array(
                    'id_induction'=>$this->input->post('id_induction'),
                    'date_enreg'=>convertion_date($this->input->post('date_enreg')),
                    'code_societe'=>$this->input->post('code_societe'),
                    'nom_societe'=>strtoupper($this->input->post('nom_societe')),
                    'nom_contractant'=>strtoupper($this->input->post('nom_contractant')),
                    'prenom_contractant'=>ucfirst($this->input->post('prenom_contractant')),
                    'date_naissance'=>convertion_date($this->input->post('date_naissance')),
                    'date_induction'=>convertion_date($this->input->post('date_induction')),
                    'date_expiration' =>convertion_date($this->input->post('date_expiration'))
                 );
              $this->_data=array_merge($this->_data,$data);
       				if($this->input->post('id_induction')==null){
       					$valide_insert = $this->Induction_model->create_induction($data);
       					$this->_data['valide_insert_ok']= 'Insertion effectuée avec succès';
       				}else{
       					#on fait plutot une modification des données
       					$valide_insert = $this->Induction_model->update_induction($data,$this->input->post('id_induction'));
       					$this->_data['valide_insert_ok']= 'Modification effectuée avec succès';
       				}

       				if($valide_insert){
                $this->_data['inductions'] = $this->Induction_model->get_all_induction();
       						$this->layout->view('induction/list_induction_form',$this->_data);
       				}else{
       					$this->_data['valide_insert_echec']= 'Echec de l\'insertion ';
       					$this->layout->view('induction/new_induction_form',$this->_data);
       				}
    		}else {
    			$this->load->view('login',$this->_data);
    		}
      }

      function ajax_add_new_societe(){
        $new_society =strtoupper($_POST['nom_societe']);
        $result=$this->Induction_model->add_society($new_society);
        echo json_encode($result);

      }

      function delete_induction($id_induction){
        $result = $this->Induction_model->delete_induction($id_induction);
        if($result){
          $message = 'Induction supprimé';
        }else {
          $message = 'Echec suppression';
        }
        $this->_data['message_insertion'] = $message;
        $this->_data['inductions'] = $this->Induction_model->get_all_induction();
        $this->layout->view('induction/list_induction_form',$this->_data);
      }


      function update_induction($id_induction){
        $info = $this->Induction_model->get_info_induction($id_induction);
        $data  = array(
                  'id_induction'=>$id_induction,
                  'date_enreg'=>convertion_date($info[0]->date_enreg,'en'),
                  'id_societe'=>$info[0]->id_societe,
                  'code_societe'=>$info[0]->code_societe,
                  'societe'=>$info[0]->societe,
                  'nom_contractant'=>$info[0]->nom_contractant,
                  'prenom_contractant'=>$info[0]->prenom_contractant,
                  'date_naissance'=>convertion_date($info[0]->date_naissance,'en'),
                  'date_induction'=>convertion_date($info[0]->date_induction,'en'),
                  'date_expiration' =>convertion_date($info[0]->date_expiration,'en')
               );
          $this->_data = array_merge($this->_data,$data);
          $this->layout->view('induction/new_induction_form',$this->_data);
      }


    }

 ?>
