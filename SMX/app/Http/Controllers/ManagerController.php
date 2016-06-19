<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/18/16
 * Time: 12:20 AM
 */
namespace App\Http\Controllers;

use App\Commodity;
use App\Export;
use App\Import;
use App\Stockreportfroms;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller{

    public function index()
    {
        $imports = DB::select('select * from imports');
        $exports = DB::select('select * from exports');
        $stockreportforms = DB::select('select * from stockreportfroms');
        $form = "所有单据";
//        return $form;
        return view('JXC.manager.index', ['name' => Auth::user()->name, 'imports' => $imports, 'exports' => $exports, 'stockreportforms' => $stockreportforms , 'form' => $form]);
    }

    public function postApprove(Request $req)
    {
        $id = $req->input('id');
        if($req->get('form') == "进货单据"){
            $target = Import::find($id);
        }elseif($req->get('form') == "销售单据"){
            $target = Export::find($id);
        }else{
            $target = Stockreportfroms::find($id);
        }
        $target->status=1;
        $target->save();
        return Redirect::route('manager');
    }

    public function findReports(Request $req)
    {
        $formtype = $req->input('formtype');
        if($formtype == 0){
            $form = "所有单据";
            $imports = DB::select('select * from imports');
            $exports = DB::select('select * from exports');
            $stockreportforms = DB::select('select * from stockreportfroms');
        }elseif($formtype == 1){
            $form = "进货单";
            $imports = DB::select('select * from imports where type = 1');
            $exports = [];
            $stockreportforms = [];
        }elseif($formtype == 2){
            $form = "进货退货单";
            $imports = DB::select('select * from imports where type = 0');
            $exports = [];
            $stockreportforms = [];
        }elseif($formtype == 3){
            $form = "销售单";
            $imports = [];
            $exports = DB::select('select * from exports where type = 1');
            $stockreportforms = [];
        }elseif($formtype == 4){
            $form = "销售退货单";
            $imports = [];
            $exports = DB::select('select * from exports where type = 0');
            $stockreportforms = [];
        }elseif($formtype == 5){
            $form = "库存报溢单";
            $imports = [];
            $exports = [];
            $stockreportforms = DB::select('select * from stockreportfroms where type = 0');
        }else{
            $form = "库存报损单";
            $imports = [];
            $exports = [];
            $stockreportforms = DB::select('select * from stockreportfroms where type = 1');
        }
        return view('JXC.manager.index', ['name' => Auth::user()->name, 'imports' => $imports, 'exports' => $exports, 'stockreportforms' => $stockreportforms, 'form' => $form]);

    }
    public function getImportDetail($id)
    {
        $result = Import::find($id);
        $com = Commodity::find($result->commodityid);
        $form = "进货单";
        return view('JXC.manager.formsDetail', ['name' => Auth::user()->name, 'result' =>$result, 'form' => $form, 'com' => $com]);
    }
    public function getExportDetail($id)
    {
        $result = Export::find($id);
        $com = Commodity::find($result->commodityid);
        $form = "销售单";
        return view('JXC.manager.formsDetail', ['name' => Auth::user()->name, 'result' =>$result, 'form' => $form, 'com' => $com]);

    }
    public function getStockreportformDetail($id)
    {
        $result = Stockreportfroms::find($id);
        $com = Commodity::find($result->commodityid);
        $form = "库存单";
        return view('JXC.manager.formsDetail', ['name' => Auth::user()->name, 'result' =>$result, 'form' => $form, 'com' => $com]);
    }
}
