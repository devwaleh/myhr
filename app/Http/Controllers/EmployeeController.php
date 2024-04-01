<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class EmployeeController extends Controller
{
    public function store (Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_id' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required'
        ]);


        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_id' => $request->company_id,
            'email' => $request->email_address,
            'phone' => $request->phone_number
        ]);

        if ($employee) {
            return redirect()->route('company.index',[$request->company_id])->with("success","Employee added successfully");
        }

    }

    public function index ($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('employee',['employee'=>$employee]);
    }

    public function update (Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email_address' => 'required|email',
            'phone_number' => 'required'
        ]);

        $employee = Employee::findOrFail($id);

        $update = $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email_address,
            'phone' => $request->phone_number
        ]);



        if ($update) {
            return redirect()->route('company.index',[$employee->company_id])->with("success","Employee updated successfully");
        }

    }

    public function destroy ($company_id,$id)
    {
        $employee = Employee::findOrFail($id);

        $delete = $employee->delete();

        if ($delete) {
            return redirect()->route('company.index',[$company_id])->with("success","Employee deleted successfully");
        }
    }



}
