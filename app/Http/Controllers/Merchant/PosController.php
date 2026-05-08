<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index()
    {
        return view('merchant.pos.index');
    }
}
