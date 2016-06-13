<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryEditController extends Controller
{
    public function index()
    {
        return view('JXC.stock.editCategory');
    }
}
