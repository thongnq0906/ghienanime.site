<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CkfinderController extends Controller
{
    public function ckfinderView()
    {

        return view('admin.ckfinder');
    }

    public function connector()
    {
        require_once public_path("ckfinder/core/connector/php/connector.php");
    }

}
