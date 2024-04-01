<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index ()
    {
        $company = Company::all();
        return view('dashboard',['companies'=>$company]);
    }
}
