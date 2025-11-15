<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\Task;


class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $presence = Presence::count();

        $tasks = Task::all();

        return view('dashboard.index', compact('employee', 'department', 'payroll', 'presence', 'tasks'));
    }

    public function presence()
    {
        $raw = Presence::where('status', 'present')
            ->selectRaw('MONTH(date) as month, COUNT(*) as total_present')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $result = [];

        // Loop 12 bulan
        for ($m = 1; $m <= 12; $m++) {
            $result[] = $raw[$m]->total_present ?? 0; // kalau tidak ada data → 0
        }

        return response()->json($result);
    }

}
