<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view("admin.reports.index");
    }

    public function sales(Request $request)
    {
        return view('admin.reports.sales');
    }

    public function products(Request $request)
    {
        return view('admin.reports.products');
    }

    public function merchants()
    {
        return view('admin.reports.merchants');
    }
}
