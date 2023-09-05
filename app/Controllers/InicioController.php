<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class InicioController extends BaseController
{
    public function index()
    {
        return view('inicio/index');
    }
}
