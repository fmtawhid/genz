<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store()
    {
        // Logic here when needed
    }

    public function edit()
    {
        return view('admin.products.edit');
    }

    public function update()
    {
        // Logic here when needed
    }

    public function show()
    {
        return view('admin.products.show');
    }

    public function destroy()
    {
        // Logic here when needed
    }
}
