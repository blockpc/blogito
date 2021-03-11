<?php

namespace App\Http\Controllers\Proyect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return view('proyect.types.index');
    }
}
