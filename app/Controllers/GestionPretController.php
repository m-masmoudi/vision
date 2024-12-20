<?php

namespace App\Controllers;

use App\Models\PretsModel;
use App\Models\SalarieModel;
use App\Controllers\BaseController;

class GestionPretController extends BaseController
{
	protected $salariesModel;
	protected $pretsModel, $theme_view;


	public function __construct()
	{


		// Use models for database interaction
		$this->salariesModel = new SalarieModel();
		$this->pretsModel = new PretsModel();

		
	}

	public function index()
	{
		$this->view_data['salaries'] = $this->salariesModel->findAll();
		$this->view_data['prets'] = $this->pretsModel->orderBy('id', 'desc')->findAll();
		// var_dump($this->view_data['prets']);
		// die;
		return view("blueline/rhpaie/gestionpret",['view_data'=>$this->view_data]);
	}

	public function create()
	{
		if ($this->request->getMethod() === 'post') {
			$data = $this->request->getPost();
			unset($data['send'], $data['userfile'], $data['file-name']);

			if (isset($data['access'])) {
				$data['access'] = implode(",", $data['access']);
			}

			$data['id_companie'] = (int) $_SESSION['current_company'];
			$this->pretsModel->insert($data);

			return redirect('gestionpret');
		}

		$this->view_data['pret'] = ['CNSS', 'Personnel'];
		$this->view_data['remboursement'] = ['Mensuel', 'Trimestriel'];
		$this->view_data['salaries'] = $this->salariesModel->findAll();
		$this->view_data['form_action'] = 'gestionpret/create';
		$this->theme_view = 'modal';
		view("bluelinerhpaie/addpret");
	}

	public function delete($id = null)
	{
		if ($id) {
			$this->pretsModel->delete($id);
		}

		return redirect('gestionpret');
	}

	public function update($id = null)
	{
		if ($this->request->getMethod() === 'post') {
			$data = $this->request->getPost();
			unset($data['send'], $data['userfile'], $data['file-name'], $data['view']);

			$data['id_companie'] = (int) $_SESSION['current_company'];
			if (isset($data['access'])) {
				$data['access'] = implode(",", $data['access']);
			}

			$this->pretsModel->update($id, $data);
			return redirect('gestionpret');
		}

		$this->view_data['pret'] = ['CNSS', 'Personnel'];
		$this->view_data['remboursement'] = ['Mensuel', 'Trimestriel'];
		$this->view_data['salaries'] = $this->salariesModel->findAll();
		$this->view_data['item'] = $this->pretsModel->find($id);
		$this->view_data['view'] = true; // Use a boolean instead of string
		$this->theme_view = 'modal';
		$this->view_data['title'] = lang('application_edit_pret');
		$this->view_data['form_action'] = "gestionpret/update/$id";
		view('blueline/rhpaie/updatepret');
	}
}
