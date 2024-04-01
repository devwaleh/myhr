<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index ($id)
    {
        $company = Company::where('id', $id)->first();
        $employees = Employee::where('company_id', $id)->get();
        return view('company',['company'=>$company, 'employees'=>$employees]);
    }

    public function store (Request $request)
    {

        // dd($request);
        $request->validate([
            'company_name' => 'required|string',
            'logo' => 'sometimes|image|dimensions:min_width=100,min_height=100',
            'email_address' => 'required|email',
            'website' => 'required|url'
        ]);


        $logo = $request->file('logo');
        if ($logo) {
            $file_name = $logo->store('public');
            $company = Company::create([
                'name' => $request->company_name,
                'email' => $request->email_address,
                'website' => $request->website,
                'logo' => $file_name
            ]);
        } else {
            $company = Company::create([
                'name' => $request->company_name,
                'email' => $request->email_address,
                'website' => $request->website,
            ]);
        }

        // dd($file_name);



        if ($company) {
            return redirect('dashboard')->with("success","Company added successfully");
        }

    }

    public function update (Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'company_name' => 'required|string',
            'logo' => 'sometimes|image|dimensions:min_width=100,min_height=100',
            'email_address' => 'required|email',
            'website' => 'required|url'
        ]);

        $company = Company::findOrFail($id);

        $logo = $request->file('logo');
        if ($logo) {
            $file_name = $logo->store('public');
            $update = $company->update([
                'name' => $request->company_name,
                'email' => $request->email_address,
                'website' => $request->website,
                'logo' => $file_name
            ]);
        } else {
            $update = $company->update([
                'name' => $request->company_name,
                'email' => $request->email_address,
                'website' => $request->website,
            ]);
        }

        // dd($file_name);



        if ($update) {
            return redirect()->route('company.index',[$id])->with("success","Company updated successfully");
        }

    }

    public function destroy ($id)
    {
        $company = Company::findOrFail($id);

        $delete = $company->delete();

        if ($delete) {
            return redirect('dashboard')->with("success","Company deleted successfully");
        }
    }



}
