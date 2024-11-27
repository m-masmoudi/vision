<?php

namespace App\Controllers;

use App\Models\CongesModel;
use App\Models\SalarieModel;
use App\Controllers\BaseController;
use App\Models\RefTypeOccurencesModel;

class CalendarCongesAbsencesController extends BaseController
{
	private RefTypeOccurencesModel $referentiels;
	private SalarieModel $salariesModel;
	private CongesModel $congesModel;

	

	public function __construct()
	{
		$this->referentiels = new RefTypeOccurencesModel();
		$this->salariesModel = new SalarieModel();
		$this->congesModel = new CongesModel();

		
		$this->setSubmenu();
	}

	

	private function hasAccessToCalendar(): bool
	{
		return array_filter($this->view_data['menu'], fn($item) => $item->link === "Calendar_conges_absences") !== [];
	}

	private function setSubmenu(): void
	{
		$this->view_data['submenu'] = [
			lang('application.application_all') => 'projects/filter/all',
			lang('application.application_open') => 'projects/filter/open',
			lang('application.application_closed') => 'projects/filter/closed'
		];
	}

	public function index()
	{
		$events = $this->db->table('t_pasa_conges')
			->whereIn('statut', ['28'])
			->get()
			->getResultArray();

		$this->view_data['events_list'] = $this->generateEventList($events);
		$this->view_data['salaries'] = $this->salariesModel->findAll();
		return  view('blueline/calendar_conges/full',['view_data'=>$this->view_data]);
	}

	private function generateEventList(array $events): string
	{
		return json_encode(array_map(fn($value) => $this->formatEvent($value), $events));
	}

	private function formatEvent($value): array
	{
		$motif = $value['motif'];
		$statut = $value['statut'];

		$result_motif = $this->db->table('ref_type_occurences')->where('id_type_occ', $motif)->get()->getRow();
		$result_statut = $this->db->table('ref_type_occurences')->where('id_type_occ', $statut)->get()->getRow();
		$salaireModel=new SalarieModel();
		


		$class = $this->getClassForMotif($motif);
		
		$time = ($motif === "162") ? date('H:i', strtotime($value['date_debut'])) . ' -- ' . date('H:i', strtotime($value['date_fin'])) : '';
     
		$salarieData=$salaireModel->find($value['id_salarie']);
	
		$nom = isset($salarieData['nom']) ? $salarieData['nom'] : "";
$prenom = isset($salarieData['prenom']) ? $salarieData['prenom'] : "";
		return [
			'title' => "{$nom} {$prenom} -- {$result_motif->name} {$time}",
			'start' => $value['date_debut'],
			'end' => date('Y-m-d H:i', strtotime($value['date_fin'] . '+1 hour')),
			'className' => $class,
			'modal' => true,
			'id' => "{$nom} {$prenom}",
			'motif' => $result_motif->name,
		];
	}

	private function getClassForMotif(string $motif): string
	{
		return match ($motif) {
			"120" => "bgColor11",
			"121" => "bgColor1",
			"122" => "bgColor3",
			"162" => "bgColor6",
			default => "defaultClass",
		};
	}

	public function update_calendar(int $id = null)
	{
		if ($this->request->getMethod() === 'post') {
			$data = $this->request->getPost();
			unset($data['send']);

			$this->db->table('t_pasa_conges')->where('id', $id)->update($data);
			return redirect('Calendar_conges_absences');
		}

		$this->view_data['motif'] = $this->referentiels->getReferentielsByIdType($this->config->item("type_id_motif_absence"));
		$this->view_data['statut'] = $this->referentiels->getReferentielsByIdType($this->config->item("type_id_statut_conges"));
		$this->view_data['salaries'] = $this->salariesModel->findAll();
		$this->view_data['item'] = $this->congesModel->find($id);

		$this->theme_view = 'modal';
		$this->view_data['title'] = lang('application.application_edit_conge');
		$this->view_data['form_action'] = "Calendar_conges_absences/update_calendar/$id";
		$this->content_view = 'rhpaie/validateconge';
	}

	public function view(): array
	{
		return $this->db->table('t_pasa_conges')
			->select('* , salaries.nom, salaries.prenom')
			->join('salaries', 'salaries.id = t_pasa_conges.id_salarie')
			->get()
			->getResultArray();
	}
}
