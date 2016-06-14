<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CategoryEditController extends Controller
{

    public function index($id)
    {
        $category = Category::find($id);
        return view('JXC.stock.editCategory',['category' => $category]);
    }
    
    public function modifyCategory(Request $request){
        $id = $request->input('id');
        $category = Category::find($id);
        $category->name=$request->input('name');
        $category->save();
        return redirect('stock');
    }
}
