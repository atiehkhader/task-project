<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'employee_first_name' => 'required',
            'employee_last_name' => 'required',
            'employee_email' => 'email',
        ]);


        Employee::create([
            'company_id' => $request->input('company_id'),
            'employee_first_name' => $request->input('employee_first_name'),
            'employee_last_name' => $request->input('employee_last_name'),
            'employee_email' => $request->input('employee_email'),
            'employee_phone' => $request->input('employee_phone'),
        ]);

        return redirect('dashboard/employees')->with('message', 'Data has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();

        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::where('id', $id)->first();
        $request->validate([
            'company_id' => 'required',
            'employee_first_name' => 'required',
            'employee_last_name' => 'required',
            'employee_email' => 'email',
        ]);

        $employee->update([
            'company_id' => $request->input('company_id'),
            'employee_first_name' => $request->input('employee_first_name'),
            'employee_last_name' => $request->input('employee_last_name'),
            'employee_email' => $request->input('employee_email'),
            'employee_phone' => $request->input('employee_phone'),
        ]);

        return redirect('dashboard/employees')->with('message', 'Data has been created !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();
        return redirect('dashboard/employees')->with('message', 'Data has been deleted!');
    }
}
