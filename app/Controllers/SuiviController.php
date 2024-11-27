<?php

namespace App\Controllers;

use DateTime;
use IntlDateFormatter;
use App\Models\UserModel;
use App\Models\SalarieModel;
use App\Controllers\BaseController;

class SuiviController extends BaseController
{

    private IntlDateFormatter $_week_day_format;
    private UserModel $userModel2;
    private SalarieModel $salarieModel;
    public function __construct() {
        $this->initialize();
        $this->userModel2=new UserModel();
        $this->salarieModel=new SalarieModel();
        $this->_week_day_format = new IntlDateFormatter(
            'en_US.UTF8',
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            "cccccc"
        );
    }

    private function initialize(): void
    {
        $this->view_data['submenu'] = [
            lang('application.application_all') => 'projects/filter/all',
            lang('application.application_open') => 'projects/filter/open',
            lang('application.application_closed') => 'projects/filter/closed',
        ];

       
    }

  

    private function hasAccessToCalendar(): bool
    {
        return !empty(array_filter($this->view_data['menu'], fn($item) => $item->link === "calendar"));
    }

    public function index()
    {
      
        $ida = $this->user['salaries_id'];
        $year = intval($this->request->getGet('year') ?: date('Y'));
        $month = intval($this->request->getGet('month') ?: date('m'));
        $department = $this->request->getGet('department');

        $salaries = $this->getSalariesByDepartment($department);
        $timestamp = mktime(0, 0, 0, $month, 1, $year);

        $this->view_data['data'] = [
            'year' => $year,
            'month' => $month,
            'department' => $department,
            'prev_year' => date("Y", strtotime("-1 months", $timestamp)),
            'next_year' => date("Y", strtotime("+1 months", $timestamp)),
            'prev_month' => date("m", strtotime("-1 months", $timestamp)),
            'next_month' => date("m", strtotime("+1 months", $timestamp)),
            'users' => $salaries,
            'events' => $this->fetchEvents($year, $month),
            'projets' => $this->fetchProjets($year, $month),
            'sujets' => array_merge($this->fetchSaisies($year, $month), $this->fetchTickets($year, $month)),
        ];

        if ($ida !== null) {
            $this->view_data['dataa'] = $this->userModel2->idsal($ida);
        }

        return  view('blueline/suivi/index',['view_data'=>$this->view_data]);
    }

    private function getSalariesByDepartment(?string $department): array
    {
        return match ($department) {
            'mms' => $this->salarieModel->getmmssalarie(),
            '2d' => $this->salarieModel->getBIM2Dsalarie(),
            '3d' => $this->salarieModel->getBIM3Dsalarie(),
            default => $this->salarieModel->getcalendersalaries(),
        };
    }

    private function fetchEvents(int $year, int $month): array
    {
        return $this->db->table('saisie_temps')
        ->distinct() // Apply DISTINCT
        ->select('users.salaries_id, ticket_par_defaults.code, saisie_temps.heures_pointees, saisie_temps.date, saisie_temps.autre_saisie')
        ->join('ticket_par_defaults', 'ticket_par_defaults.id = saisie_temps.ticket_id', 'left') // Join ticket_par_defaults
        ->join('users', 'saisie_temps.utilisateur_id = users.id', 'left') // Join users
        ->where('YEAR(saisie_temps.date)', $year) // Filter by year
        ->where('MONTH(saisie_temps.date)', $month) // Filter by month
        ->where('saisie_temps.heures_pointees !=', 0.00) // Filter non-zero heures_pointees
        ->orderBy('users.salaries_id, saisie_temps.date') // Order by salaries_id and date
        ->get()
        ->getResultArray(); // Get the result as an array
    }

    private function fetchSaisies(int $year, int $month): array
    {
        return $this->db->table('saisie_temps')
            ->distinct() // Apply DISTINCT to the query
            ->select('ticket_par_defaults.code, saisie_temps.heures_pointees, users.salaries_id, saisie_temps.date')
            ->join('users', 'users.id = saisie_temps.utilisateur_id', 'left') // Join users table
            ->join('ticket_par_defaults', 'ticket_par_defaults.id = saisie_temps.ticket_id', 'left') // Join ticket_par_defaults
            ->where('YEAR(saisie_temps.date)', $year) // Filter by year
            ->where('MONTH(saisie_temps.date)', $month) // Filter by month
            ->where('saisie_temps.heures_pointees !=', 0.00) // Exclude zero heures_pointees
            ->groupBy('ticket_par_defaults.code, saisie_temps.heures_pointees, users.salaries_id, saisie_temps.date') // Group to prevent ambiguity
            ->get()
            ->getResultArray(); // Fetch results as an array
    }

    private function fetchTickets(int $year, int $month): array
    {
        return $this->db->table('saisie_temps')
            ->distinct() // Apply DISTINCT to the query
            ->select('users.salaries_id, saisie_temps.date, tickets.subject, saisie_temps.heures_pointees')
            ->join('tickets', 'tickets.id = saisie_temps.ticket_id', 'left') // Join tickets table
            ->join('users', 'saisie_temps.utilisateur_id = users.id', 'left') // Join users table
            ->where('YEAR(saisie_temps.date)', $year) // Filter by year
            ->where('MONTH(saisie_temps.date)', $month) // Filter by month
            ->where('tickets.id >', 15) // Filter tickets with id > 15
            ->where('saisie_temps.heures_pointees !=', 0.00) // Exclude zero heures_pointees
            ->orderBy('users.salaries_id, saisie_temps.date') // Order by salaries_id and date
            ->get()
            ->getResultArray(); // Fetch results as an array
    }

    private function fetchProjets(int $year, int $month): array
    {
        return $this->db->table('tickets')
            ->select('users.salaries_id, projects.name, tickets.subject, tickets.start, tickets.end')
            ->join('projects', 'tickets.project_id = projects.id')
            ->join('users', 'tickets.collaborater_id = users.id')
            ->where('YEAR(tickets.start)', $year)
            ->where('YEAR(tickets.end)', $year)
            ->where('MONTH(tickets.start)', $month)
            ->where('MONTH(tickets.end)', $month)
            ->orderBy('salaries_id, start, end')
            ->get()->getResult();
    }

    public function getMonthData(int $year, int $month_num): array
    {
        $month_num = (int) $month_num; // Ensure no leading zeros
        $day_num = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
        $month = [
            'num' => $month_num,
            'name' => get_month_name($month_num),
            'year' => $year,
            'days' => [],
        ];

        for ($i = 1; $i <= $day_num; $i++) {
            $date_obj = new DateTime("$year-$month_num-$i");
            $week_day_num = $date_obj->format('N');
            $week_day_name = datefmt_format($this->_week_day_format, $date_obj->getTimestamp());
            $today = (new DateTime())->format('Y-m-d') === $date_obj->format('Y-m-d');

            $month['days'][$i] = [
                'num' => $i,
                'week_num' => $week_day_num,
                'name' => $week_day_name,
                'date_string' => $date_obj->format('Y-m-d'),
                'is_today' => $today,
            ];
        }

        return $month;
    }

    private function _header(int $year, int $month): array
    {
        $month_data = $this->get_month_data($year, $month);
        return [
            'month_data' => $month_data,
            'name' => $month_data['name'],
        ];
    }

    public function edit(int $year = 0, int $month = 0, int $item_id = 0): void
    {
        $users = $this->salarieModel->getcalendersalaries();
        $m_data = month_offset($year, $month, 0);
        $next_month_data = month_offset($year, $month, 1);
        $prev_month_data = month_offset($year, $month, -1);

        $this->view_data['data'] = [
            'users' => $users,
            'name' => $this->getMonthData($m_data['year'], $m_data['month'])['name'],
            'data_m' => $this->getMonthData($m_data['year'], $m_data['month']),
            'year' => $m_data['year'],
            'month' => $m_data['month'],
            'year_prev' => $prev_month_data['year'],
            'month_prev' => $prev_month_data['month'],
            'year_next' => $next_month_data['year'],
            'month_next' => $next_month_data['month'],
            'item_id' => $item_id,
        ];

        $this->content_view = 'suivi/edit';
    }
}
