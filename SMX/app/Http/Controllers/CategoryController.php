<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $result = DB::select('select * from categories');
        return view('JXC.stock.index',['categories' => $result]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $name = $category->name;
        $category->delete();
        session()->flash('message', $name."已经被移除");
        return Redirect::back();
    }

    public function getAdd() {
        $result = DB::select('select * from categories');
        return view('JXC.stock.index',['name' => Auth::user()->username, 'categories' => $result]);
    }

    public function postAdd(Request $req) {
        $this->validate($req,[
            'name' => 'required|max:50',
            'parent' => 'required',
        ]);
        if($req->get('parent') == 0) {
            $ca = new Category();
            $ca->name = $req->get('name');
            $ca->parent = $req->get('parent');
            $ca->save();
            CategoryController::updateScore();
            return Redirect::route('addca');
        }
        $parent = DB::select('select * from categories where id = ?', [$req->get('parent')]);
        if($parent != null){
            $ca = new Category();
            $ca->name = $req->get('name');
            $ca->parent = $req->get('parent');
            $ca->save();
            CategoryController::updateScore();
        }else {
            return Redirect::route('stock')
                ->withInput()
                ->withErrors('父类别不存在！');
        }
        return Redirect::route('addca');
    }

    public function updateScore(){
        $user = User::find(Auth::user()->id);
        $user->count=$user->count+1;
        $user->save();
        return redirect('stock');
    }
}
