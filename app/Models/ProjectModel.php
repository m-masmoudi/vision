<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
  protected $table = 'projects';
  protected $primaryKey = 'id';

  protected $allowedFields = [
    'reference',
    'name',
    'description',
    'start',
    'end',
    'delivery',
    'progress',
    'tracking',
    'time_spent',
    'datetime',
    'sticky',
    'company_id',
    'note',
    'progress_calc',
    'hide_tasks',
    'enable_client_tasks',
    'project_num',
    'creation_date',
    'type_projet',
    'nature_projet',
    'ref_projet',
    'etat_projet',
    'chef_projet_id',
    'chef_projet_client_id',
    'sub_client_id',
    'surface',
    'longueur',
    'date_relance_1',
    'date_relance_2',
    'date_relance_3'
  ];


  public function getActivities($project_id)
  {
    return $this->db->table('project_has_activities')
    ->where('project_id', $project_id)
    ->orderBy('datetime', 'DESC')
    ->get()
    ->getResult();
  }
  public function getProjectMilestones(int $projectId)
  {
      return $this->db->table('project_has_milestones')
          ->where('project_id', $projectId)
          ->orderBy('orderindex')
          ->get()
          ->getResult();
  }
  public function getInvoices($project_id)
  {
      return $this->db->table('project_has_invoices')
          ->where('project_id', $project_id)
          ->get()
          ->getResult();
  }
  public function getFiles($project_id)
  {
      return $this->db->table('project_has_files')
          ->where('project_id', $project_id)
          ->get()
          ->getResult();
  }

  public function getProjectWorkers(int $projectId)
  {
      return $this->db->table('project_has_workers')
          ->where('project_id', $projectId)
          ->get()
          ->getResult();
  }

  public function overdueByDate(array $compArray, string $date): array
  {
    $builder = $this->builder();
    $builder->select('*')
      ->where('progress !=', 100)
      ->where('end <', $date);

    if (!empty($compArray)) {
      $builder->groupStart()
        ->whereIn('company_id', $compArray)
        ->groupEnd();
    }

    return $builder->orderBy('end')
      ->get()
      ->getResultArray();
  }

  public static function getAllTasksTime($projectID): string
  {
    $timesheetsModel = new ProjectHasTimeSheetModel();

    $tracking = $timesheetsModel->where('project_id', $projectID)->sum('time');

    // Convert total time from seconds to hours and minutes
    $trackingHours = floor($tracking / 3600);
    $trackingMinutes = floor(($tracking % 3600) / 60);

    // Use the language helper for translations
    return sprintf('%d %s %d %s', $trackingHours, lang('application.hours'), $trackingMinutes, lang('application.minutes'));
  }

  public function getTypeProjetById($id_type)
  {
    return $this->db->table('ref_type_occurences')
      ->select('name')
      ->where('id', $id_type)
      ->get()
      ->getRow();
  }

  public function getTicketsByProject($id_projet)
  {
    return $this->db->table('tickets')
      ->select('tickets.id, tickets.subject, users.firstname, users.lastname')
      ->join('users', 'tickets.collaborater_id = users.id')
      ->where('project_id', $id_projet)
      ->get()
      ->getResult();
  }

  public function getAll()
  {
    return $this->db->table('projects')
      ->select('projects.*, ref_type_occurences.name as txt_type_projet, companies.name as txt_client_name')
      ->join('ref_type_occurences', 'projects.type_projet = ref_type_occurences.id', 'left')
      ->join('companies', 'projects.company_id = companies.id', 'left')
      ->where('progress <', 100)
      ->orderBy('id', 'DESC')
      ->get()
      ->getResult();
  }

  public function calculateHours($id)
  {
    return $this->db->query("SELECT SUM(REPLACE(s.heures_pointees, '.30', '.50')) as periode
            FROM saisie_temps s, tickets t 
            WHERE s.ticket_id = t.id AND t.project_id = $id")
      ->getRow();
  }

  public function getProjectRef($id)
  {
    return $this->db->table('projects')
      ->where('id', $id)
      ->get()
      ->getRow();
  }

  public function getProjectClientName($id)
  {
    return $this->db->query("SELECT CONCAT(clients.firstname, ' ', clients.lastname) as name_client 
            FROM clients, projects 
            WHERE projects.sub_client_id = clients.id and projects.id = $id")
      ->getRow();
  }
  public function getOpenProjectsCount()
  {
    return $this->where('etat_projet', 'open')->countAllResults(); // Change 'open' to the correct status value
  }

  public function getAllProjectsCount()
  {
    return $this->countAllResults();
  }

  public function getRows(array $postData = [])
    {
        $builder = $this->builder();
        $this->_get_datatables_query($builder, $postData);

        if (isset($postData['length']) && $postData['length'] != -1) {
            $builder->limit($postData['length'], $postData['start'] ?? 0);
        }

        return $builder->get()->getResult();
    }

    public function getRows2(array $postData = [])
    {
        $builder = $this->builder();
        $this->_get_datatables_query2($builder, $postData);

        if (isset($postData['length']) && $postData['length'] != -1) {
            $builder->limit($postData['length'], $postData['start'] ?? 0);
        }

        return $builder->get()->getResult();
    }

    // Count all records
    public function countAll()
    {
        return $this->countAllResults();
    }

    // Count records based on filter parameters
    public function countFiltered(array $postData = [])
    {
        $builder = $this->builder();
        $this->_get_datatables_query($builder, $postData);
        return $builder->countAllResults(false);
    }

    public function countFiltered2(array $postData = [])
    {
        $builder = $this->builder();
        $this->_get_datatables_query2($builder, $postData);
        return $builder->countAllResults(false);
    }

    // Datatable query for getRows()
    private function _get_datatables_query($builder, array $postData = [])
    {
        $idss = $this->user->salaries_id;  // Assuming 'salaries_id' is part of the user session data
        $naturename = $this->idsal($idss); // Assuming this method returns a nature name based on 'salaries_id'
    
        // Set up the query builder
        $builder->select('projects.*, progress_ref.name as state, projects.reference as reference_project, projects.name as project, ref_type_occurences.name as nature, companies.name as client')
                ->from('projects')
                ->join('ref_type_occurences', 'ref_type_occurences.id = projects.type_projet')
                ->join('companies', 'companies.id = projects.company_id', 'left')
                ->join('progress_ref', 'progress_ref.ref = projects.progress')
                ->where('ref_type_occurences.name', $naturename)
                ->orderBy('projects.creation_date', 'desc');
    
        // Apply search filters
        if (!empty($postData['search']['value'])) {
            foreach ($this->column_search as $i => $item) {
                if ($i === 0) {
                    $builder->groupStart(); // Begin the OR group if it's the first column
                    $builder->like($item, $postData['search']['value']);
                } else {
                    $builder->orLike($item, $postData['search']['value']);
                }
    
                if (count($this->column_search) - 1 == $i) {
                    $builder->groupEnd(); // End the OR group after the last column
                }
            }
        }
    
        // Apply ordering if provided
        if (isset($postData['order'])) {
            $orderColumn = $this->column_order[$postData['order'][0]['column']];
            $orderDirection = $postData['order'][0]['dir'];
            $builder->orderBy($orderColumn, $orderDirection);
        } else if (isset($this->order)) {
            // Default ordering if no specific order is provided
            $order = $this->order;
            $builder->orderBy(key($order), $order[key($order)]);
        }
    }
         

    // Datatable query for getRows2()
    private function _get_datatables_query2($builder, array $postData = [])
    {
        // Set up the query builder
        $builder->select('*')
                ->select('proj.id as proj_id, progress_ref.name as state, proj.reference as reference_project, proj.name as project_name, ref_type_occurences.name as nature, companies.name as client')
                ->from('projects as proj')
                ->join('ref_type_occurences', 'ref_type_occurences.id = proj.type_projet')
                ->join('companies', 'companies.id = proj.company_id', 'left')
                ->join('progress_ref', 'progress_ref.ref = proj.progress')
                ->orderBy('proj.creation_date', 'desc');
    }


    public function getPeriodTickets_Byprojet(int $id_projet = null, bool $total = false, bool $sous_proj_only = false): array
    {
        $builder = $this->db->table('tickets as t')
                            ->join('saisie_temps as st', 't.id = st.ticket_id', 'left');
    
     
        if ($sous_proj_only) {
        
          $subQuery = $this->db->table('project_has_sub_projects as sp')
                         ->select('id as sub_project_id_saisie, project_id as project_pere')
                         ->where((!is_null($id_projet)) ? 'sp.project_id = ' . $id_projet : '1=1')
                         ->getCompiledSelect();
          
          $builder->from("($subQuery) as p");
          $builder->join('tickets as t', 't.sub_project_id = p.sub_project_id_saisie', 'left');
          
      } else {
     
          $subQuery = $this->db->table('projects')
                         ->select('id as project_id_saisie, id as project_pere')
                         ->where((!is_null($id_projet)) ? 'id = ' . $id_projet : '1=1')
                         ->getCompiledSelect();
          
          $builder->from("($subQuery) as p");
          $builder->join('tickets as t', 't.project_id = p.project_id_saisie', 'left');
      }
        $builder = $this->db->table('saisie_temps as st')
        ->select("
            CAST(REPLACE(SUBSTRING(SUBSTRING_INDEX(st.heures_pointees, '.', 1), 
                LENGTH(SUBSTRING_INDEX(st.heures_pointees, '.', 1 - 1)) + 1), 
                '.', '') AS UNSIGNED) AS nb_heures,
            LPAD(CAST(REPLACE(SUBSTRING(SUBSTRING_INDEX(st.heures_pointees, '.', 2), 
                LENGTH(SUBSTRING_INDEX(st.heures_pointees, '.', 2 - 1)) + 1), 
                '.', '') AS UNSIGNED), 2, '0') AS nb_minutes
        ", false);
 
   
    
      
      
    
        $query = $builder->get();
        
        $tab = $query->getResultArray();
 
        // Process hours and minutes calculations in PHP
        foreach ($tab as $key => $row){
        
          $total_heures = getTotalHeures($row['nb_heures'], $row['nb_minutes']);
          $tab[$key]['total'] = $total_heures .'.'. getResteMinutes($row['nb_minutes']); //$row->nb_heures .'.'.$row->nb_minutes;
          $tab[$key]['nb_days'] = FLOOR($total_heures / 8);
          $tab[$key]['nb_days_mod ']= $total_heures % 8;
      }
    
        return $tab;
    }
    
    

    
    
    

}
