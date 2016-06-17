<?php

namespace App\Http\Controllers;

use App\Export;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Client;
use App\User;
use App\Commodity;
use App\Import;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    public function getClient()
    {
        $result = DB::select('select * from clients');
        return view('JXC.sale.index', ['name' => Auth::user()->name, 'clients' => $result]);
    }

    public function getAddclient()
    {
        return view('JXC.sale.addclient', ['name' => Auth::user()->username]);
    }

    public function addClient(Request $req)
    {
        $this->validate($req,[
            'name' => 'required|max:50',
            'type' => 'required',
            'level' => 'required',
            'tel' => 'required',
            'address' => 'required',
        ]);

        $c = new Client();
        $c->name = $req->get('name');
        $c->type = $req->get('type');
        $c->level = $req->get('level');
        if($req->get('level') == 3){
            $c->limit = 10000;
        }elseif ($req->get('level') == 2){
            $c->limit = 100000;
        }else{
            $c->limit = 1000000;
        }
        $c->tel = $req->get('tel');
        $c->address = $req->get('address');
        $c->in = 0;
        $c->out = 0;
        $c->overall = 0;
        $c->save();
        SaleController::updateScore(1,0);
        return Redirect::route('sale');

    }

    public function findClient(Request $req)
    {
        $this->validate($req,[
            'name' => 'required|max:50',
            'type' => 'required',
        ]);

        $result = DB::select('select * from clients where type = ? and name = ?', [$req->get('type'), $req->get('name')]);
        return view('JXC.sale.index', ['name' => Auth::user()->name, 'clients' => $result]);

    }

    //进货管理

    public function getImports()
    {
        $imports = DB::select('select * from imports');
        return view('JXC.sale.import', ['name' => Auth::user()->name, 'imports' => $imports]);
    }

    public function getAddImports()
    {
        $clients = DB::select('select * from clients');
        $commodities = DB::select('select * from commodities');
        return view('JXC.sale.addImport', ['name' => Auth::user()->name, 'clients' => $clients, 'commodities' => $commodities]);
    }

//    进货单通过审批后,会更改库存数据和客户的应收应付数据
    public function addImports(Request $req)
    {
        $this->validate($req,[
            'clientid' => 'required',
            'type' => 'required',
            'commodityid' => 'required',
            'number' => 'required',
        ]);

        $import = new Import();
        $import->status = $req->get('status');
        $import->type = $req->get('type');

        $c = DB::select('select * from clients where id = ?', [$req->get('clientid')]);
        $import->clientname = $c[0]->name;
        $import->clientid = $req->get('clientid');

        $import->operatorid = $req->get('operatorid');
        $import->operatorname = $req->get('operatorname');
        $import->number = $req->get('number');
        $import->commodityid = $req->get('commodityid');
        $commodity = DB::select('select * from commodities where id = ?', [$req->get('commodityid')]);
        $import->overall = $req->get('number') * $commodity[0]->avgin;
        $import->save();
        SaleController::updateScore(0,$import->overall);
        return Redirect::route('import');
    }

    public function findImports(Request $req)
    {
        $this->validate($req,[
            'by' => 'required',
            'content' => 'required',
        ]);
        if($req->get('by') == 1){
            $result = DB::select('select * from imports where clientname = ?', [$req->get('content')]);
        }else{
            $tmp = DB::select('select * from commodities where name = ?',[$req->get('content')]);
            $result = DB::select('select * from imports where commodityid= ?', [$tmp[0]->id]);
        }

        return view('JXC.sale.import', ['name' => Auth::user()->name, 'imports' => $result]);
    }

    public function showImportDetail($id)
    {
        $import = Import::find($id);
        $com = Commodity::find($import->commodityid);
        return view('JXC.sale.importDetail', ['name' => Auth::user()->name, 'import' => $import, 'com' => $com]);
    }

    public function updateScore($score,$num){
        $user = User::find(Auth::user()->id);
        if($num == 0){
            $score = 1;
        }else{
            $score = $num / 1000;
        }
        $user->count=$user->count+$score;
        $user->save();
    }

    //销售管理
    public function getExports()
    {
        $exports = DB::select('select * from exports');
        return view('JXC.sale.export', ['name' => Auth::user()->name, 'exports' => $exports]);
    }

    public function getAddExports()
    {
        $clients = DB::select('select * from clients');
        $commodities = DB::select('select * from commodities');
        return view('JXC.sale.addExport', ['name' => Auth::user()->name, 'clients' => $clients, 'commodities' => $commodities]);
    }

//  销售单通过审批后,会更改库存数据和客户的应收应付数据
    public function addExports(Request $req)
    {
        $this->validate($req,[
            'clientid' => 'required',
            'type' => 'required',
            'commodityid' => 'required',
            'number' => 'required',
        ]);

        $export = new Export();
        $export->status = $req->get('status');
        $export->type = $req->get('type');

        $c = DB::select('select * from clients where id = ?', [$req->get('clientid')]);
        $export->clientname = $c[0]->name;
        $export->clientid = $req->get('clientid');

        $export->operatorid = $req->get('operatorid');
        $export->operatorname = $req->get('operatorname');
        $export->number = $req->get('number');

        $commodity = DB::select('select * from commodities where id = ?', [$req->get('commodityid')]);
        $export->commodityid = $req->get('commodityid');

        $export->initoverall = $req->get('number') * $commodity[0]->avgout;
        $export->discount = SaleController::getDiscount($c[0],$export->initoverall);
        $export->overall = $export->initoverall - $export->discount;
        $export->save();
        SaleController::updateScore(0,$export->overall);
        return Redirect::route('export');
    }

    public function findExports(Request $req)
    {
        $this->validate($req,[
            'by' => 'required',
            'content' => 'required',
        ]);
        if($req->get('by') == 1){
            $result = DB::select('select * from exports where clientname = ?', [$req->get('content')]);
        }else{
            $tmp = DB::select('select * from commodities where name = ?',[$req->get('content')]);
            $result = DB::select('select * from exports where commodityid= ?', [$tmp[0]->id]);
        }

        return view('JXC.sale.export', ['name' => Auth::user()->name, 'exports' => $result]);
    }

    public function showExportDetail($id)
    {
        $export = Export::find($id);
        $com = Commodity::find($export->commodityid);
        return view('JXC.sale.exportDetail', ['name' => Auth::user()->name, 'export' => $export, 'com' => $com]);
    }

    public function getDiscount($client,$overall){
        if($client->level == 3){
            $discount = $overall * 0.01;
        }elseif($client->level == 2){
            $discount = $overall * 0.02;
        }else{
            $discount = $overall * 0.05;
        }
        return $discount;
    }
}
