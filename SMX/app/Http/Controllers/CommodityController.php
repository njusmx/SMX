<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/15/16
 * Time: 12:08 AM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommodityController extends Controller
{
    public function index()
    {
        $result = DB::select('select * from commodities');
        return view('JXC.commodity.index',['commodities' => $result]);
    }

    public function destroy($id)
    {
        $commodity = Commodity::find($id);
        $name = $commodity->name;
        $commodity->delete();
        session()->flash('message', $name."已经被移除");
        return Redirect::back();
    }

    public function getAdd() {
        $result = DB::select('select * from commodities');
        return view('JXC.commodity.index',['name' => Auth::user()->username, 'commodities' => $result]);
    }

    public function postAdd(Request $req) {
        $this->validate($req,[
            'name' => 'required|max:50',
            'type' => 'required|max:50',
            'category' => 'required|integer',
            'alarm' => 'required|integer',
        ]);

        $parent = DB::select('select * from commodities where name = ? and type = ?', [$req->get('name'), $req->get('type')]);
        if($parent != null){
            $ca = new Commodity();
            $ca->name = $req->get('name');
            $ca->type = $req->get('type');
            $ca->avgin = $req->get('avgin');
            $ca->avgout = $req->get('avgout');
            $ca->category = $req->get('category');
            $ca->alarm = $req->get('alarm');
            $ca->save();

        }else {
            return Redirect::route('commodity')
                ->withInput()
                ->withErrors('商品已存在！');
        }
        return Redirect::route('addcom');
    }
}
