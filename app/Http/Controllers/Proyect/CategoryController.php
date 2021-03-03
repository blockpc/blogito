<?php

namespace App\Http\Controllers\Proyect;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('proyect.categories.index');
    }
}
