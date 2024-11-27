<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Controllers\BaseController;
use App\Models\RefTypeOccurencesModel;

class CalendarTicketsController extends BaseController
{
	protected $referentiels;
    protected $userModel;
    protected $projectModel;
	public function __construct()
    {
        $this->referentiels = new RefTypeOccurencesModel();
        $this->userModel = new UserModel();
        $this->projectModel = new ProjectModel();
    }
	public function index()
    {
        mb_internal_encoding('UTF-8');

        if (!$this->user) {
            return redirect()->to('login');
        }

        $events = $this->getEvents();
        $this->view_data['events_list'] = $this->generateEventList($events);
        $this->view_data['projects'] = $this->projectModel->findAll();
        $this->view_data['salaries'] = $this->userModel->where(['status' => 'active', 'admin' => '0'])->findAll();

        return view('blueline/calendar_tickets/full', ['view_data'=>$this->view_data]);
    }

    private function getEvents()
    {
        return $this->db->table('tickets')
            ->select('tickets.*, users.firstname, users.lastname')
            ->join('users', 'users.id = tickets.collaborater_id', 'inner')
            ->where('tickets.collaborater_id IS NOT NULL')
            ->where('tickets.start IS NOT NULL')
            ->where('tickets.end IS NOT NULL')
            ->orderBy('users.id', 'ASC')
            ->get()
            ->getResultArray(); // Use getResultArray for consistent array output
    }

    private function generateEventList(array $events): string
    {
        $eventList = [];

        foreach ($events as $event) {
            // var_dump($event);
            // die;
            $user = $this->getUser($event['collaborater_id']);
            $project = $this->getProject($event['project_id']);
            $color = $this->getColor($event['collaborater_id']);
            $service = $this->getService($project['type_projet']);
            $url = base_url("ctickets/view/{$event['id']}");

            $eventList[] = [
                'title' => addslashes(ucwords(strtolower("{$user['lastname']} {$user['firstname']} - Tâche : {$event['id']} - $service - {$event['subject']} - Projet : N°{$project['project_num']} - {$project['name']}"))),
                'start' => $event['start'],
                'end' => date('Y-m-d', strtotime($event['end'] . ' + 1 day')),
                'modal' => 'true',
                //'className' => $user->classname,
                'description' => $project['name'],
                'service' => $service,
                'user' => ucwords(strtolower("{$user['lastname']} {$user['firstname']}")),
                'color' => $color,
                'url' => $url,
            ];
        }

        return json_encode($eventList);
    }
    public function getTicketsToDatatables()
{
    // Set UTF-8 encoding
    mb_internal_encoding('UTF-8');

    $data = [];
    $request = $this->request->getPost(); 
    $start = $request['start'] ?? 0;
    $draw = $request['draw'] ?? 1;

   
    $ticketModel = new \App\Models\TicketModel();

   
    $tickets = $ticketModel->getRows($request);

   
    $i = $start;
    foreach ($tickets as $ticket) {
        $i++;
        $data[] = [
            $ticket['ticket_id'],
            $ticket['ticket_id'],
            $ticket['subject'],
            $ticket['project'],
            $ticket['start'],
            $ticket['end'],
            $ticket['collaborater_firstname'] . ' ' . $ticket['collaborater_lastname'],
            $ticket['type'],
        ];
    }

   
    $output = [
        "draw" => (int) $draw,
        "recordsTotal" => $ticketModel->countAll($request),
        "recordsFiltered" => $ticketModel->countFiltered($request),
        "data" => $data,
    ];

    // Return JSON response
    return $this->response->setJSON($output);
}

    private function getUser(int $id)
    {
        $builder = $this->db->table('users');
        return $builder->select('firstname, lastname')
            ->where('id', $id)
            ->get()
            ->getRowArray(); // Use getRowArray for array output
    }

    private function getProject(int $id)
{
    $builder = $this->db->table('projects');
    return $builder->select('name, type_projet, project_num')
        ->where('id', $id)
        ->get()
        ->getRowArray(); // Use getRowArray for array output
}

private function getColor(int $id): string
{
    return match ($id) {
        63 => '#FF0000',
        76 => '#FF00FF',
        44 => '#9acd32',
        61 => '#00ced1',
        78 => '#0000cd',
        79 => '#fa8072',
        77 => '#7b68ee',
        92 => '#33FF68',
        93 => '#FF3352',
        94 => '#E98C24',
        46 => '#00ffff',
        68 => '#808000',
        40 => '#ff8c00',
        85 => '#8b008b',
        37 => '#900C3F',
        36 => '#cd853f',
        71 => '#FF5733',
        67 => '#ff6347',
        69 => '#C70039',
        default => '#000000',
    };
}

private function getService(string $type): string
{
    return match ($type) {
        "96" => "MMS",
        "95" => "BIM 2D",
        "130" => "BIM 3D",
        default => "Unknown Service",
    };
}

}