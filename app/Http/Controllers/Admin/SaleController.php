<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        return view('admin.sales.index');
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store()
    {
        // Logic here when needed
    }

    public function show()
    {
        return view('admin.sales.show');
    }

    public function destroy()
    {
        // Logic here when needed
    }
}
