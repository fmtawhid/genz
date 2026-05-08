<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index()
    {
        return view("admin.pos.index");
    }
}
