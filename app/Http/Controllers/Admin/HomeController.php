<?php

namespace App\Http\Controllers\Admin;

use App\AdminLog;
use App\Extensions\AdminTable;
use App\Http\Controllers\Controller;
use App\Statistic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $statistics = Statistic::getChart();

        $logs = AdminLog::getAllPaginated($request);

        $logsTable = new AdminTable($logs, [
            'created_at' => 'Data',
            'login' => 'Login',
            'bool|success' => 'Status',
        ], 'Ostatnie logowania');

        return view('admin.home.index', compact('logsTable', 'statistics'));
    }
}
