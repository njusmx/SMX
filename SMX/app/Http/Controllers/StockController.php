<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\User;
use App\Stockreportfroms;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $result = DB::select('select * from categories');
        return view('JXC.stock.index', ['name' => Auth::user()->username, 'categories' => $result]);
    }
    //库存盘点
    public function check()
    {
        $result = DB::select('select * from commodities');
        return view('JXC.stock.check', ['name' => Auth::user()->username, 'commodities' => $result]);
    }
    //库存查看
    public function show()
    {
        $result = DB::select('select * from commodities');
        return view('JXC.stock.show', ['name' => Auth::user()->username, 'commodities' => $result]);
    }

    public function getCorrect()
    {
        $stocklessforms = DB::select('select * from stockreportfroms where loss = 1');
        $stockmoreforms = DB::select('select * from stockreportfroms where loss = 0');
        return view('JXC.stock.correct', ['name' => Auth::user()->name, 'stocklessforms' => $stocklessforms ,'stockmoreforms' => $stockmoreforms]);
    }

    public function getInform()
    {
        $lesswarns = DB::select('select * from commodities where lesswarn >= number');
        $morewarns = DB::select('select * from commodities where morewarn <= number');
        return view('JXC.stock.less', ['name' => Auth::user()->name, 'lesswarns' => $lesswarns, 'morewarns' => $morewarns]);
    }

    public function postCorrect(Request $req)
    {
        $this->validate($req,[
            'name' => 'required',
            'type' => 'required',
            'diff' => 'required|integer',
            'creator' => 'required',
        ]);

        $com = DB::select('select * from commodities where name = ? and type = ?', [$req->get('name'), $req->get('type')]);
        if($com != null){
            $ca = new Stockreportfroms();
            $ca->commodity = $req->get('name');
            $ca->type = $req->get('type');
            $ca->diff = $req->get('diff');
            $ca->creator = $req->get('creator');
            $ca->status = 0;
            $ca->loss = $req->get('loss');
            $ca->save();
            StockController::updateScore();
        }else {
            return Redirect::route('correct')
                ->withInput()
                ->withErrors('商品不存在！');
        }
        return Redirect::route('correct');
    }

    public function updateScore(){
        $user = User::find(Auth::user()->id);
        $user->count=$user->count+2;
        $user->save();
        return redirect('stock');
    }
}
