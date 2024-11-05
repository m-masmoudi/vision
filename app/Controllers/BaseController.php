<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CoreModel;

use App\Models\VCompanieModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\ModuleModel;
use App\Models\AccesRigthModel;
use App\Models\PrivatemessageModel;
use App\Models\ModulesSousModel;
use App\Models\ProjectModel;
use App\Models\TicketModel;

use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $security;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    protected $coreSettingModel, $userModel, $clientModel, $VCompanieModel, $ticketModel;

    protected $accessRigth, $module, $privatemessage, $modulesSousModel, $projectModel;
    protected array $view_data = [];

    private function processPostData(): void
    {
        if (!empty($_POST)) {
            $fieldList = ["description", "message", "terms", "note", "invoice_terms", "estimate_terms", "bank_transfer_text"];
            foreach ($_POST as $key => $value) {
                if (in_array($key, $fieldList)) {
                    $this->removeBadTags($key);
                } else {
                    // $_POST[$key] = $this->security->xss_clean($_POST[$key]);
                    //$_POST[$key] = $this->security->xss_clean($_POST[$key]);
                }
            }
        }
    }

    private function removeBadTags(string $field): void
    {
        $_POST[$field] = preg_replace('/(&lt;|<)\?php(.*)(\?(&gt;|>))/imx', '[php] $2 [php]', $_POST[$field]);
        $_POST[$field] = preg_replace('/((&lt;|<)(\s*|\/)script(.*?)(&gt;|>))/imx', '[script]', $_POST[$field]);
        $_POST[$field] = preg_replace('/((&lt;|<)(\s*)link(.*?)\/?(&gt;|>))/imx', '[link $4]', $_POST[$field]);
        $_POST[$field] = preg_replace('/((&lt;|<)(\s*)(\/*)(\s*)style(.*?)(&gt;|>))/imx', '[style]', $_POST[$field]);
    }

    private function setupLanguage(): void
    {
        //$language = $this->request->getCookie('fc2language') ?: $this->view_data['core_settings']['language'] ?: 'french';
        $language = $this->request->getLocale();
        $this->view_data['langshort'] = ($language === "french") ? "fr" : "en";
        $this->view_data['timeformat'] = ($language === "french") ? "H:i" : "h:i A";
        $this->view_data['dateformat'] = ($language === "french") ? "d-m-Y" : "F j, Y";
        $this->view_data['time24hours'] = ($language === "french");


        //$this->lang->load('application', $language);
        //$this->lang->load('messages', $language);
        // $this->lang->load('event', $language);
        // $this->lang->load('referentiel', $language);

        $this->view_data['current_language'] = $language;
    }

    private function getInstalledLanguages(): array
    {
        return array_filter(scandir('app/Language'), fn($entry) => $entry !== '.' && $entry !== '..');
    }

    private function setupUserAndClientData(): void
    {
        //var_dump($this->session = session()->get('user_id'));

        // die;

        $user_id = session()->get('user_id');
        $this->user = $user_id ? $this->userModel->find($user_id) : false;
        $this->client = session()->get('client_id') ? $this->clientModel->find(session()->get('client_id'))->getResultArray() : False;

        if ($this->user) {
            $userIsSuperAdmin = ($this->user['admin'] == '1') ? true : false;
            $this->setupUserAccess($userIsSuperAdmin);
        } else {
        // var_dump(session()->get('client_id'));
      //   die();
            $access = explode(",", $this->client);
            $this->view_data['menu'] = $this->module->whereIn('id', $access)->where('type', 'client')->orderBy('sort', 'asc')->get()->getResultArray();;
        }
    }

    private function setupUserAccess($userIsSuperAdmin): void
    {
        $user_id = session()->get('user_id');
        $this->view_data['user_id'] = $user_id;
        $accessRigth = $this->accessRigth->where('user_id', $user_id)->first();
        $access = explode(",", $accessRigth['menu']);
        $accessSubmenu = explode(",", $accessRigth['submenu']);

        $this->loadMenu($access, $accessSubmenu, $userIsSuperAdmin);
    }

    private function loadMenu(array $access, array $accessSubmenu, $userIsSuperAdmin): void
    {
        $submenu = '';
        $comp_array = false;
        if (isset($_SESSION['current_company'])) {
            //$sub = $this->submenu->findAll();
            $menu = $this->module->whereIn('id', $access)->where('type', 'main')->orderBy('sort', 'asc')->get()->getResultArray();
            ;
            $submenu = $this->modulesSousModel->getSubmenu($accessSubmenu);
            $this->view_data['menu'] = $menu;
            $this->view_data['submenuRight'] = $submenu;

        } else {
            $this->view_data['menu'] = $this->module->where('type', 'main')->orderBy('sort', 'asc')->get()->getResultArray();
        }
        if (!$userIsSuperAdmin) {
            $comp_array = array();
            $comp_array = $this->accessRigth->find(array('conditions' => array('user_id=?', $this->view_data['user_id'])))->company_id;
        }
        $this->view_data['module_permissions'] = array();
        $notification_list = array();
        foreach ($this->view_data['menu'] as $key => $value) {
            array_push($this->view_data['module_permissions'], $value['link']);
        }
        $this->view_data['accessSubmenu'] = $accessSubmenu;
        $this->view_data['widgets'] = $this->module->whereIn('id', $access)->where('type', 'widget')->findAll();
        $this->view_data['user_online'] = $this->userModel
            ->where('last_active >', time() - (30 * 60))
            ->where('status', 'active')
            ->findAll();
        $this->view_data['client_online'] = $this->clientModel
            ->where('last_active >', time() - (30 * 60))
            ->where('inactive', '0')
            ->findAll();

        // Custom SQL query for sticky projects
        $this->view_data['sticky'] = $this->projectModel->db->query(
            "SELECT DISTINCT projects.name, projects.id, projects.tracking, projects.progress 
             FROM projects 
             JOIN project_has_workers ON projects.id = project_has_workers.project_id 
             WHERE projects.sticky = 1 
             AND project_has_workers.intervenant_id = ?",
            [$this->view_data['user_id']]
        )->getResult();

        // Count of new tickets
        // $this->view_data['tickets_new'] = $this->ticketModel->newTicketCount($this->user->id, $comp_array);

        //var_dump($this->view_data['widgets']);
        //die();
    }

    private function updateLastActive(): void
    {
        if ($this->user) {
            $this->user->last_active = time();
            $this->user->save();
        }
    }

    private function loadAdditionalData(): void
    {
        // Load additional necessary data
        // $this->view_data['messages_new'] = $this->privatemessage->where('status', 'New')->where('recipient', 'u' . $this->view_data['user_id'])->count();
        $this->view_data['v_companies'] = $this->VCompanieModel->findAll();
        // Additional data fetching can be placed here...
    }
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->security = service('security');
        $request = service('request');
        // E.g.: $this->session = \Config\Services::session();


        $this->coreSettingModel = new CoreModel();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->accessRigth = new AccesRigthModel();
        $this->module = new ModuleModel();
        $this->privatemessage = new PrivatemessageModel();
        $this->VCompanieModel = new VCompanieModel();
        $this->modulesSousModel = new ModulesSousModel();
        $this->projectModel = new ProjectModel();
        $this->ticketModel = new TicketModel();


        $this->processPostData();

        $this->view_data['core_settings'] = $this->coreSettingModel->first();
        $this->view_data['act_uri'] = $request->getUri()->getSegment(1, 0);
        $this->view_data['lastsec'] = $request->getUri()->getTotalSegments();
        $this->view_data['act_uri_submenu'] = $request->getUri()->getSegment($request->getUri()->getTotalSegments());
        $this->view_data['datetime'] = date('Y-m-d H:i');
        $this->view_data['nom_licence'] = $this->VCompanieModel->getCompany();

        // Setup language and fetch installed languages
        $this->setupLanguage();
        //$this->view_data['installed_languages'] = $this->getInstalledLanguages();

        // Setup user and client data
        $this->setupUserAndClientData();

        // Update user last active
        if ($this->user || $this->client) {
            // $this->updateLastActive();
            $this->view_data["note_templates"] = "";
        }

        // Load additional data
        $this->loadAdditionalData();


        $session = \Config\Services::session();
        $language = \Config\Services::language();

        switch ($language->getLocale()) {
            case "fr":
                $this->view_data['langshort'] = "fr";
                $this->view_data['timeformat'] = "H:i";
                $this->view_data['dateformat'] = "d-m-Y";
                break;
            case "en":
                $this->view_data['langshort'] = "en";
                $this->view_data['timeformat'] = "h:i K";
                $this->view_data['dateformat'] = "F j, Y";
                $this->view_data['time24hours'] = "false";
                break;

        }
        
        $language->setLocale($session->lang);
        $this->db = \Config\Database::connect();
        
      //  $this->view_data['userimage'] = get_UserPic($this->user['userpic'], $this->user['email']);

    }
}
