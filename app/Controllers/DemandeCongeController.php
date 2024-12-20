<?php

namespace App\Controllers;

use Config\OccConfig;
use App\Models\SalarieModel;

use App\Controllers\BaseController;
use App\Models\RefTypeOccurencesModel;

class DemandeCongeController extends BaseController
{
    protected $referentiels;
    protected $salarieModel,$config;
    public function __construct()
    {
        $this->referentiels = new RefTypeOccurencesModel();
        $this->salarieModel = new SalarieModel();
        $this->config=new  OccConfig();
     

       
    }


    public function index()
    {
        // Get user ID from session or Auth
        $userId = session()->get('user_id'); // Adjust key based on your session data structure
         
    
        // Fetch user details
        $user = $this->db->table('salaries')
            ->select('salaries.id, salaries.nom, salaries.prenom, salaries.mail, salaries.droit_conge')
            ->join('users', 'salaries.id = users.salaries_id')
            ->where('users.id', $userId)
            ->get()
            ->getRow();
    
       
    $salarieId='';
    $solde='';
      if($user){
        $solde = $user->droit_conge;
        $salarieId = $user->id;
        $this->view_data['user'] = $user->nom . ' ' . $user->prenom;
       }
       
    
        // Fetch leaves (conges) for the user
        $conges = [];
        if ($salarieId) {
            $conges = $this->db->table('t_pasa_conges')
                ->where('id_salarie', $salarieId)
                ->get()
                ->getResult();
        }
    
        // Fetch additional data for the view
        $this->view_data['conges'] = $conges;
        $this->view_data['solde'] = $solde;
     
        $this->view_data['motif'] = $this->referentiels ->getReferentielsByIdType($this->config->type_id_motif_absence);
        $this->view_data['statut'] = $this->referentiels ->getReferentielsByIdType($this->config->type_id_statut_conges);
    
        // Load the view
        return view('blueline/rhpaie/all_for_user', ['view_data' => $this->view_data]);
    }
    


    /**
     * Création d'un congés
     */
    function create2()
    {

        //get user
        $user = $this->user->id;
        $sql = "SELECT salaries.id,salaries.nom , salaries.prenom ,salaries.mail,salaries.droit_conge  FROM salaries
       join users on salaries.id = users.salaries_id 
       WHERE(users.id = $user)";
        $user_name = $this->db->query($sql)->result()[0];


        $salarie_id = $user_name->id;



        $this->view_data['user'] = $user_name->nom . ' ' . $user_name->prenom;

        $this->view_data['id'] = $salarie_id;


        if ($_POST) {
            unset($_POST['send']);
            $_POST['id_salarie'] = $salarie_id;
            $_POST['date_debut'] = ($_POST['date_debut']);
            $_POST['motif'] = $_POST['motif'];
            $_POST['statut'] = "162";
            $_POST['date_fin'] = $_POST['date_fin'];
            $this->db->select('mail,nom , prenom');
            $this->db->from('salaries');
            $this->db->where('id', $salarie_id);
            $email = $this->db->get()->result()[0];
            //liste email parametre



            $this->db->select('email_notification');
            $this->db->from('core');
            $this->db->where('id', '2');
            $liste = $this->db->get()->result()[0];

            $pieces = explode(";", $liste->email_notification);
            $rowns = implode(',', $pieces);
            //$motif = get_texte_occurence($_POST['motif']);
            $motif = $this->referentiels->getOccNameById($_POST['motif']);
            //var_dump($motif->name);exit;
            $this->load->library('email');


            $this->email->from($email->mail, $email->nom . ' ' . $email->prenom);
            $this->email->to($rowns);
            $this->email->subject('Demande de congés Du ' . $_POST['date_debut'] . ' au ' . $_POST['date_fin']);
            $this->email->message('Bonjour ,' . '<br>' . '<br>' . 'Une nouvelle demande de congés est envoyée par ' . $email->nom . ' ' . $email->prenom . '<br>' . $motif->name . ' du ' . $_POST['date_debut'] . ' au ' . $_POST['date_fin'] . '<br>' . 'Veuillez consulter la liste des demandes en attente .' . '<br>' . '<br>' . 'Cordialement ,');
            if ($this->email->send()) {
                $this->session->set_flashdata('message', 'success:' . $this->lang->line('messages_email_success'));
            } else {
                show_error($this->email->print_debugger());

            }



            if (!$this->db->insert('t_pasa_conges', $_POST))
                show_error("L'enregistrement des congés a échoué.", "404", $heading = 'Une erreur a été rencontrée');
            redirect('demandeConge');
        } else {


            $this->view_data['motif'] = $this->referentiels->getReferentielsByIdType($this->config->item("type_id_motif_absence"));
            $this->view_data['statut'] = $this->referentiels->getReferentielsByIdType($this->config->item("type_id_statut_conges"));
            $this->view_data['salaries'] = Salaries::find('all');

            $this->theme_view = 'modal';
            $this->view_data['title'] = $this->lang->line('application_conge_info');
            $this->view_data['form_action'] = 'demandeConge/create2';
            $this->content_view = 'rhpaie/addconge';



        }


    }

    public function create()
    {
        $userId = session()->get('user')['id'];
        $user_name = $this->salarieModel->getUserInfo($userId);
        $salarie_id = $user_name->id;

        $data = [
            'user' => "{$user_name->nom} {$user_name->prenom}",
            'id' => $salarie_id,
            'motif' => $this->referentiels->getReferentielsByIdType(config("app.type_id_motif_absence")),
            'statut' => $this->referentiels->getReferentielsByIdType(config("app.type_id_statut_conges")),
            'salaries' => $this->salarieModel->findAll(),
        ];

        if ($this->request->getMethod() === 'post') {
            $this->handlePostCreate($salarie_id);
        } else {
            return view('rhpaie/addconge', $data);
        }
    }
    /**
     * UPDATE  DEMANDE
     */

    function updatedemande($id)
    {
        if ($_POST) {
            unset($_POST['send']);
            $this->load->database();
            $sql = "SELECT  * FROM t_pasa_conges
            WHERE(id = $id)";
            $requet = $this->db->query($sql)->result()[0];
            $salarie_id = $requet->id_salarie;

            $data = array(
                'date_debut' => $_POST['date_debut'],
                'date_fin' => $_POST['date_fin'],
                'motif' => $_POST['motif'],
            );
            $this->db->where('id', $id);
            $this->db->set($data);
            $item = $this->db->update('t_pasa_conges');
            //ENVOYER UN EMAIL
            $motif = $this->referentiels->getOccNameById($_POST['motif']);
            $this->db->select('email_notification');
            $this->db->from('core');
            $this->db->where('id', '2');
            $liste = $this->db->get()->result()[0];
            $pieces = explode(";", $liste->email_notification);
            $rowns = implode(',', $pieces);
            $this->db->select('mail,nom , prenom');
            $this->db->from('salaries');
            $this->db->where('id', $salarie_id);
            $email = $this->db->get()->result()[0];
            //var_dump($email,$rowns,$motif);exit;
            $this->load->library('email');
            $this->email->from($email->mail, $email->nom . ' ' . $email->prenom);
            $this->email->to($rowns);
            $this->email->subject('Demande de congés est modifier  par ' . $email->nom . ' ' . $email->prenom);
            $this->email->message('Bonjour ,' . '<br>' . '<br>' . 'j\'ai modifier mon congés avec le date de debut ' . $_POST['date_debut'] . ' , un date de fin  ' . $_POST['date_fin'] . ' et avec le statut ' . $motif . '<br>' . 'Veuillez consulter la liste des demandes en attente .' . '<br>' . '<br>' . 'Cordialement ,');
            $this->email->send();
            //MESSAGE FLASH  
            if (!$item) {
                $this->session->set_flashdata('message', 'error:' . $this->lang->line('messages_error_update_demande'));
            } else {
                $this->session->set_flashdata('message', 'success:' . $this->lang->line('messages_update_demande'));
            }
            redirect('demandeConge');

        } else {
            $sql = "SELECT  date_debut,date_fin,motif FROM t_pasa_conges
            WHERE(id = $id)";
            $requet = $this->db->query($sql)->result()[0];
            $this->view_data['conge'] = $requet;
            $this->view_data['motif'] = $this->referentiels->getReferentielsByIdType($this->config->item("type_id_motif_absence"));
            $this->theme_view = 'modal';
            $this->view_data['title'] = $this->lang->line('application_conge_info');
            $this->view_data['form_action'] = 'demandeConge/updatedemande/' . $id;
            $this->content_view = 'rhpaie/updateconge';
        }



    }

    /**
     * DELETE  DEMANDE
     */

    function deletedemande($id)
    {
        $this->load->database();
        $this->db->where('id', $id);
        $item = $this->db->delete('t_pasa_conges');
        //MESSAGE FLASH  
        if (!$item) {
            $this->session->set_flashdata('message', 'error:' . $this->lang->line('messages_error_delete_demande'));
        } else {
            $this->session->set_flashdata('message', 'success:' . $this->lang->line('messages_delete_demande'));
        }
        redirect('demandeConge');
    }
}