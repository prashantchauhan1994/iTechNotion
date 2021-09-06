<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeePunchIn;

class EmployeeController extends Controller
{
    public function index()
    {
        $title = 'Employees';
        $employees = Employee::all();
        return view('employee.index', compact('title','employees'));
    }

    public function ajax(Request $request)
    {
        $columns = array('id', 'name', 'punchin_date', 'punchin_time', 'punchout_date', 'punchout_time', 'action');

        $employees = new Employee;
        $totalData = $employees->count();
        $totalFiltered = $employees->count();

        $limit = $request->input('length');
        $start = $request->input('start');

        $dir = "desc";
        $order = "created_at";
        if(isset($columns[$request->input('order.0.column')]))
        {
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
        }

        if($request->input('search.value') != "")
        {
            $search = $request->input('search.value');
            $employees = $employees->where('name','LIKE',"%{$search}%");
            $totalFiltered = $employees->count();

        }
        $employees = $employees->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $data = array();
        if($employees->count() > 0)
        {
            foreach ($employees as $employee)
            {
                $nestedData['id'] = $employee->id;
                $nestedData['name'] = $employee->name;

                $nestedData['punchin_date'] = $employee->punchinTime ? $employee->punchinTime->created_at->format('Y-m-d') : "";
                $nestedData['punchin_time'] = $employee->punchinTime ? $employee->punchinTime->created_at->format('H:i:s') : "";

                $nestedData['punchout_date'] = $employee->punchoutTime ? $employee->punchoutTime->created_at->format('Y-m-d') : "";
                $nestedData['punchout_time'] = $employee->punchoutTime ? $employee->punchoutTime->created_at->format('H:i:s') : "";

                $action = '<div class="tb-icon-wrap">';
                $action .= '<a href="'.route('employee.view',$employee->id).'" class="btn btn-info btn-xs action-btn" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>';
                $nestedData['action'] = $action;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
        ]);

        if($validator->fails()) {
            $message = $validator->errors()->all()[0];
            $retArr = ['success' => 0,'message' => $message];
            return response()->json($retArr);
        }
        EmployeePunchIn::create([
            'employee_id' => $request->employee_id,
        ]);

        $retArr = ['success' => 1,'message' => "Punch In successfully!"];
        return response()->json($retArr);
    }

    public function view($id)
    {
        $employee = Employee::find($id);
        if(!$employee) {
            return redirect(route('employee.index'))->with(['alert-class' => 'error', 'message' => "Invalid Access!"]);
        }
        $title = "View Employee";
        return view('employee.view',compact('title', 'employee'));
    }
}
