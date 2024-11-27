<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

use App\Models\CompanyModel;
use App\Models\InvoiceModel;
use App\Models\SettingModel;
use App\Controllers\BaseController;
use App\Models\PrivatemessageModel;

// use App\Models\ProjectHasTaskModel;

class ReportsController extends BaseController
{

	protected  InvoiceModel $invoiceModel2;
	protected  SettingModel $settingModel;
	protected  PrivatemessageModel $privateMessageModel;
	// // protected ProjectHasTaskModel $projectHasTaskModel;
	// protected  CompanyModel $companyModel;
	function __construct()
	{

		$this->invoiceModel2 = new InvoiceModel();
		// $this->settingModel = new SettingModel();
		// $this->privateMessageModel = new PrivatemessageModel();
		// // $this->projectHasTaskModel = new ProjectHasTaskModel();
		// $this->companyModel = new CompanyModel();

	
		// $this->loadEvents();

	}


	// private function loadEvents(): void
	// {
	// 	if (in_array("messages", session()->get('module_permissions'))) {
	// 		$this->view_data["message"] = $this->privateMessageModel->getRecentMessages(session()->get('user_id'));
	// 	}

	// 	if (in_array("projects", session()->get('module_permissions'))) {
	// 		$this->view_data["tasks"] = $this->projectHasTaskModel->getUserTasks(session()->get('user_id'));
	// 	}
	// }
	public function period(): void
	{
		$report = $this->request->getPost('report');
		$start = $this->request->getPost('start');
		$end = $this->request->getPost('end');

		if ($report === "clients") {
			$this->incomeByClients($start, $end);
		} else {
			$this->index($start, $end);
		}
	}

	public function index(string $start = null, string $end = null)
	{
		
		$start = $start ?: date('Y-01-01');
		$end = $end ?: date('Y-12-31');

		//$coreSettings = $this->settingModel->getCompanySettings(session()->get('current_company'));
		$this->view_data["stats"] = $this->invoiceModel2->getStatisticFor($start, $end);
		$this->view_data["stats_expenses"] = $this->invoiceModel2->getExpensesStatisticFor($start, $end);
		$stats = $this->invoiceModel2->getStatisticFor($start, $end);
        $statsExpenses = $this->invoiceModel2->getExpensesStatisticFor($start, $end);
		$this->view_data["stats_start_short"] = $start;
		$this->view_data["stats_end_short"] = $end;
        
		$this->prepareStatisticsView($start, $end, $this->view_data['core_settings']);
		$totalIncomeForYear = 0;
        $totalExpenses = 0;

        // Format the monthly income and expense statistics
        $labels = [];
        $line1 = [];
        $line2 = [];
        $untilMonth = (int)date('m', strtotime($end));

        for ($i = 1; $i <= $untilMonth; $i++) {
            $monthName = Time::createFromDate(2016, $i, 1)->format('M');
            $monthName = lang('application_' . strtolower($monthName));
            $monthlyIncome = 0;
            $monthlyExpense = 0;

            // Check for monthly income statistics
            foreach ($stats as $value) {
                $month = (int)date('m', strtotime($value['paid_date']));
                if ($month === $i) {
                    $monthlyIncome = (float)$value['summary'];
                    $totalIncomeForYear += $monthlyIncome;
                }
            }

            // Check for monthly expense statistics
            foreach ($statsExpenses as $value) {
                $month = (int)date('m', strtotime($value['date']));
                if ($month === $i) {
                    $monthlyExpense = (float)$value['summary'];
                    $totalExpenses += $monthlyExpense;
                }
            }

            // Add formatted data to arrays
            $labels[] = '"' . $monthName . '"';
            $line1[] = number_format($monthlyIncome, 2);
            $line2[] = number_format($monthlyExpense, 2);
        }

        // Compile final data for view
        $this->view_data['labels'] = implode(',', $labels);
        $this->view_data['line1'] = implode(',', $line1);
        $this->view_data['line2'] = implode(',', $line2);
        $this->view_data['totalIncomeForYear'] = $totalIncomeForYear;
        $this->view_data['totalExpenses'] = $totalExpenses;
        $this->view_data['totalProfit'] = $totalIncomeForYear - $totalExpenses;
        $this->view_data['form_action'] = base_url('reports/period');
		return view('blueline/reports/reports',['view_data'=>$this->view_data]);
	}

	private function prepareStatisticsView(string $start, string $end,  $coreSettings)
	{
		// Process and prepare view data for statistics
		$this->view_data["stats_start"] = date($coreSettings['date_format'], strtotime($start));
		$this->view_data["stats_end"] = date($coreSettings['date_format'], strtotime($end));
		// Additional processing...
	}

	public function incomeByClients(string $start = null, string $end = null): void
	{
		$start = $start ?: date('Y-01-01');
		$end = $end ?: date('Y-12-31');

		$this->view_data["stats"] = $this->invoiceModel->getStatisticForClients($start, $end);
		$this->view_data['form_action'] = 'reports/period';
		$this->content_view = 'reports/reports';
	}

}


