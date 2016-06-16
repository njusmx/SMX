<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/16/16
 * Time: 11:47 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CommodityEditController extends Controller
{

    public function index($id)
    {
        $commodity = Commodity::find($id);
        $category = Category::find($commodity->category);
        return view('JXC.commodity.editCommodity',['commodity' => $commodity, 'category' => $category]);
    }

    public function modifyCommodity(Request $request){
        $this->validate($request,[
            'avgin' => 'required',
            'avgout' => 'required',
            'lesswarn' => 'required|integer',
            'morewarn' => 'required|integer',
        ]);
        $id = $request->input('id');
        $commodity = Commodity::find($id);
        $commodity->avgin=$request->input('avgin');
        $commodity->avgout=$request->input('avgout');
        $commodity->lesswarn=$request->input('lesswarn');
        $commodity->morewarn=$request->input('morewarn');
        $commodity->save();
        return redirect('stock/commodity');
    }
}
