<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/18/16
 * Time: 12:20 AM
 */
namespace App\Http\Controllers;

use App\Client;
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
        return view('JXC.manager.index', ['name' => Auth::user()->name, 'imports' => $imports, 'exports' => $exports, 'stockreportforms' => $stockreportforms , 'form' => $form]);
    }

    public function updateScore($score,$num){
        $user = User::find(Auth::user()->id);
        if($num == 0){
        }else{
            $score = $num / 1000;
        }
        $user->count=$user->count+$score;
        $user->save();
    }

    public function postApprove(Request $req)
    {
        $id = $req->input('id');
        if($req->get('form') == "进货单据"){
            $target = Import::find($id);
            $commodity = Commodity::find($target->commodityid);
            $client = Client::find($target->clientid);
            //进货
            if($target->type == 1){
                $commodity->number = $commodity->number + $target->number;//改库存
                $commodity->numin = $commodity->numin + $target->number;//进货数量
                $client->out = $client->out + $target->overall; //改应付
                ManagerController::updateScore(0,$target->overall);
                //进货退货
            }else{
                $commodity->number = $commodity->number - $target->number;//改库存
                $commodity->numin = $commodity->numin - $target->number;//进货数量
                $client->out = $client->out - $target->overall; //改应付
            }
            if($client->in > 100000){
                $client->level = 1;
            }elseif($client->in < 100000 && $client->in > 10000){
                $client->level = 2;
            }else{
                $client->level = 3;
            }
            $commodity->save();
            $client->save();

        }elseif($req->get('form') == "销售单据"){
            $target = Export::find($id);
            $commodity = Commodity::find($target->commodityid);
            $client = Client::find($target->clientid);
            //销售
            if($target->type == 1){
                $commodity->number = $commodity->number - $target->number;//改库存
                $commodity->numout = $commodity->numout + $target->number;//改售出数量
                $client->in = $client->in + $target->overall; //改应收
                ManagerController::updateScore(0,$target->overall);
                //销售退货
            }else{
                $commodity->number = $commodity->number + $target->number;//改库存
                $commodity->numout = $commodity->numout - $target->number;//改售出数量
                $client->in = $client->in - $target->overall; //改应收
            }
            if($client->in > 100000){
                $client->level = 1;
            }elseif($client->in < 100000 && $client->in > 10000){
                $client->level = 2;
            }else{
                $client->level = 3;
            }
            $commodity->save();
            $client->save();
        }else{
            $target = Stockreportfroms::find($id);
            ManagerController::updateScore(2,0);
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
