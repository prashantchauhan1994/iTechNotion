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
}
