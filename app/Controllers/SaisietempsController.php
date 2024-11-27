<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RefTypeModel; // Fix the typo in the model name
use App\Models\RefTypeOccurencesModel;

class SaisietempsController extends BaseController
{
    private string $formatDate = 'm-Y';
    private array $optionsMois = [];
    private ?string $moisCourant = null;
    private array $joursTravailMois = [];
    private RefTypeModel $refType;
    private RefTypeOccurencesModel $referentiels; // Ensure this is correctly spelled
    private UserModel $userModel2;
  

    // Add properties for type_ticket_projet and type_ticket_defaut
    protected $type_ticket_projet;
    protected $type_ticket_defaut;

    public function __construct()
    {
        // Load models using dependency injection
        $this->refType = new RefTypeModel();
        $this->referentiels = new RefTypeOccurencesModel();
        $this->userModel2 = new UserModel();

        // Check user access
        if (!session()->get('client')) {
            return redirect('login');
        }

        $idType = $this->refType->getRefTypeByName("ticket")->id;
        $submenus = $this->referentiels->getReferentielsByIdType($idType);

        $this->view_data['submenu'] = [];
        foreach ($submenus as $submenu) {
            $this->view_data['submenu'][lang('application_' . $submenu->name)] = 'ctickets/filter/' . $submenu->id;
        }

        // Initialize type_ticket_projet and type_ticket_defaut
        $this->type_ticket_projet = $this->referentiels->getReferentiels(
            config("type_id_type_ticket"),
            config("ticket_projet")
        );
        $this->type_ticket_defaut = $this->referentiels->getReferentiels(
            config("type_id_type_ticket"),
            config("ticket_par_defaut")
        );

        $this->type_ticket_projet->alias = 'P';
        $this->type_ticket_defaut->alias = 'D';
    }

    public function index(string $mois = null, string $annee = null)
    {
        return $this->getData(true, $mois, $annee);
    }

    private function getData(bool $isSaisie, string $mois = null, string $annee = null)
    {
        
        $user=session()->get('user');
        $idadmin = $user['salaries_id'];

        if ($idadmin === null) {
            return view('blueline/saisietemps/vi2', ['view_data'=>$this->view_data]);
        } else {
            $this->view_data['data'] = $this->userModel->idsal($idadmin);
            return view('blueline/saisietemps/vi', ['view_data'=>$this->view_data]);
        }
    }
}
