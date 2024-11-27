<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\RefTypeModel;
use App\Models\SalarieModel;
use App\Models\RefTypeOccurencesModel;
use CodeIgniter\HTTP\RedirectResponse;

class GestionSalarieController extends BaseController
{
	protected $salarieModel;
	protected $referentiels;
	protected $refType;

	public function __construct()
	{
		$this->salarieModel = new SalarieModel();
		$this->referentiels = new RefTypeOccurencesModel();
		$this->refType = new RefTypeModel();

		if (!session()->get('client') && !session()->get('user')) {
			return redirect()->to('login');
		}
	}

	public function index(): string
	{
		$this->view_data['salaries'] = $this->salarieModel->findAll();
		return view('blueline/rhpaie/gestionsalarie', ['view_data'=>$this->view_data]);
	}

	public function create(): RedirectResponse|string
	{
		if ($this->request->getMethod() === 'post') {
			$postData = $this->request->getPost();
			unset($postData['send']);

			// Handling access checkbox values
			if (isset($postData['access'])) {
				$postData['access'] = implode(",", $postData['access']);
			}

			// Insert new function if not exists
			if (empty($postData['idfonction'])) {
				$functionData = [
					'id_type' => 19,
					'name' => $postData['fonctionname'],
					'description' => $postData['description']
				];
				$this->referentiels->insert($functionData);
				$newFunction = $this->referentiels
					->where('id_type', 19)
					->where('name', $postData['fonctionname'])
					->where('description', $postData['description'])
					->first();
				$postData['idfonction'] = $newFunction['id'];
			}

			unset($postData['fonctionname'], $postData['description']);

			// Insert employee record
			$postData['etat'] = 1;
			$this->salarieModel->insert($postData);
			return redirect()->to('gestionsalarie');
		} else {
			$data = [
				'genre' => $this->referentiels->getWhere(['id_type' => 13])->findAll(),
				'situations' => $this->referentiels->getWhere(['id_type' => 12])->findAll(),
				'fonctions' => $this->referentiels->getWhere(['id_type' => 19])->findAll(),
				'typecontarts' => $this->referentiels->getWhere(['id_type' => 30])->findAll(),
				'form_action' => site_url('gestionsalarie/create')
			];
			return view('rhpaie/salaries/new', $data);
		}
	}

	public function delete(int $id): RedirectResponse
	{
		if ($this->salarieModel->delete($id)) {
			session()->setFlashdata('message', 'success:' . lang('messages_delete_salarié_success'));
		} else {
			session()->setFlashdata('message', 'error:' . lang('messages_delete_salarié_error'));
		}

		return redirect()->to('gestionsalarie');
	}

	public function update(int $id): RedirectResponse|string
	{
		if ($this->request->getMethod() === 'post') {
			$postData = $this->request->getPost();
			unset($postData['fonctionname'], $postData['description'], $postData['send']);

			// Handling file upload
			$file = $this->request->getFile('profile_image');
			if ($file && !$file->hasMoved()) {
				$newName = $file->getRandomName();
				$file->move('./uploads', $newName);
				$postData['file'] = $newName;
			}

			// Update employee data
			$this->salarieModel->update($id, $postData);
			return redirect()->to('gestionsalarie');
		} else {
			$data = [
				'situations' => $this->referentiels->getWhere(['id_type' => 12])->findAll(),
				'salarie' => $this->salarieModel->find($id),
				'fonctions' => $this->referentiels->getWhere(['id_type' => 19])->findAll(),
				'typecontrats' => $this->referentiels->getWhere(['id_type' => 30])->findAll(),
				'form_action' => site_url('gestionsalarie/update/' . $id)
			];
			return view('rhpaie/salaries/edit', $data);
		}
	}

	public function updatedetail(int $id): RedirectResponse|string
	{
		if ($this->request->getMethod() === 'post') {
			$postData = $this->request->getPost();
			unset($postData['send']);

			// Handle gender-based file setting
			if ($postData['genre'] == '82') {
				$postData['file'] = 'femme2.jpg';
			} else {
				$postData['file'] = 'default.jpg';
			}

			// Update salarie details
			$this->salarieModel->update($id, $postData);
			return redirect()->to('gestionsalarie/view/' . $id);
		} else {
			$data = [
				'genre' => $this->refType->getReferentielsByIdType(13),
				'situations' => $this->referentiels->getWhere(['id_type' => 12])->findAll(),
				'salarie' => $this->salarieModel->find($id),
				'form_action' => site_url('gestionsalarie/updatedetail/' . $id)
			];
			return view('rhpaie/salaries/editdetail1', $data);
		}
	}
	public function view($id = false)
	{
		if ($this->request->getPost()) {
			return redirect()->to('gestionsalarie');
		} else {
			// Get the 'genre' data
			$genre = $this->db->table('ref_type_occurences')
							  ->select('*')
							  ->where('id_type', 13)
							  ->get()
							  ->getResult();
	
			// Get the 'situations' data
			$situations = $this->db->table('ref_type_occurences')
								   ->select('*')
								   ->where('id_type', 12)
								   ->get()
								   ->getResult();
	
			// Get the 'fonctions' data
			$fonctions = $this->db->table('ref_type_occurences')
								  ->select('*')
								  ->where('id_type', 19)
								  ->get()
								  ->getResult();
	
			// Fetch the 'salarie' information using the model
			$salarieModel = new \App\Models\SalarieModel(); // Assuming your model is named 'SalarieModel'
			$salarie = $salarieModel->getInfoSalarie($id);
	
			// Pass data to the view
			$this->view_data['genre'] = $genre;
			$this->view_data['situations'] = $situations;
			$this->view_data['fonctions'] = $fonctions;
			$this->view_data['salarie'] = $salarie;  // Assuming getInfoSalarie returns an array
			$this->view_data['idpnl'] = $id;
			$this->view_data['form_action'] = 'gestionsalarie/view/' . $id;
	
			// Load the view
			return view('blueline/rhpaie/salaries/view', ['view_data'=>$this->view_data]);
		}
	}
	// Additional methods like updatecontact, etc., should follow the same structure.
}
