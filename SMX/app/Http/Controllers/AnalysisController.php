<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/20/16
 * Time: 1:41 AM
 */

namespace App\Http\Controllers;

use App\Client;
use App\Commodity;
use App\Export;
use App\Import;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AnalysisController extends Controller
{
    
    public function getClientAnalysis()
    {
        $users =  Client::where('type','=',"销售商")->get();
        $R = [];
        $F = [];
        $M = [];
        $strategy = [];
        $undos = [];
        if(count($users)) {
            for ($index = 0; $index < count($users); $index++) {
                $R[$index] = "";
                $F[$index] = 0;
                $M[$index] = 0;
                $strategy[$index] = 0;
                $undos[$index] = (object) [
                    'undocount' => 0,
                    'client' => Client::find(2),
                ];
            }
        }
//        return Client::find(2);
//        return $undos[0]->client->id;
        if(count($users)){
            for($index = 0; $index<count($users); $index++){
                $exports = Export::where('type','=',1)->where('status','=',1)->where('clientid','=',$users[$index]->id)->get();
                $F[$index] = count($exports);
                $recent = Export::where('type','=',1)->where('status','=',1)->where('clientid','=',$users[$index]->id)->orderBy('created_at', 'desc')->first();
                $R[$index] = substr($recent->created_at,0,10);
                $overall = 0;
                for($i = 0; $i<count($exports); $i++){
                    $overall = $overall + $exports[$i]->overall;
                }
                $M[$index] = $overall/count($exports);
                $days=abs((strtotime(date("Y-m-d"))-strtotime($R[$index]))/86400);
                if($days <= 100 && $R[$index] > 2 && $M[$index] > 300){
                    $strategy[$index] = 1;
                }elseif($days <= 100 && $R[$index] <= 2 && $M[$index] <= 300){
                    $strategy[$index] = 2;
                }elseif($days <= 100 && $R[$index] <= 2 && $M[$index] > 300){
                    $strategy[$index] = 3;
                }elseif($days > 100 && $R[$index] > 2 && $M[$index] > 300){
                    $strategy[$index] = 4;
                }elseif($days <= 100 && $R[$index] > 2 && $M[$index] <= 300){
                    $strategy[$index] = 5;
                }elseif($days > 100 && $R[$index] <= 2 && $M[$index] > 300){
                    $strategy[$index] = 6;
                }elseif($days > 100 && $R[$index] > 2 && $M[$index] <= 300){
                    $strategy[$index] = 7;
                }elseif($days > 100 && $R[$index] <= 2 && $M[$index] <= 300){
                    $strategy[$index] = 8;
                }
            }
        }
        if(count($users)){
            for($index = 0; $index<count($users); $index++){
                $exports = Export::where('type','=',0)->where('status','=',1)->where('clientid','=',$users[$index]->id)->get();
                $undos[$index]->undocount = count($exports);
                $undos[$index]->client = $users[$index];
            }
        }
        $undos = AnalysisController::bubble_sort($undos);
        return view('JXC.manager.clientAnalysis',['users' => $users,'R' => $R,'F' => $F,'M' => $M,'strategy' => $strategy,'undos' => $undos]);
    }

    public function bubble_sort($arr){
        $count = count($arr);
        if ($count <= 0) return false;
        for($i=0; $i<$count; $i++){
            for($j=$count-1; $j>$i; $j--){
                if ($arr[$j]->undocount > $arr[$j-1]->undocount){
                    $tmp = $arr[$j];
                    $arr[$j] = $arr[$j-1];
                    $arr[$j-1] = $tmp;
                }
            }
        }
        return $arr;
      }


    public function getSaleAnalysis()
    {
        $commodities = DB::select('select * from commodities');
        $hotten = Commodity::soldMost()->take(10)->get();
        $coldten = Commodity::soldLeast()->take(10)->get();
        return view('JXC.manager.saleAnalysis',['name' => Auth::user()->username, 'commodities' => $commodities, 'hotten' => $hotten, 'coldten' => $coldten]);
    }

    public function getMonthSaleDetail($id)
    {
        $commodity = Commodity::find($id);
        $time = [];
        $num = [];
        $avg = 0;
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = date('Y')."-0".(string)($month+1);
            }else{
                $ym = date('Y')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $num[$month] = (integer)Export::where('commodityid','=',$id)->where('created_at','LIKE',$condition)->sum('number');
            $time[$month] = $ym;
            $title = date('Y');
            $avg = $avg + $num[$month];
        }
        return view('JXC.manager.commoditySaleChart',['name' => Auth::user()->name, 'commodity' => $commodity, 'time' => $time, 'num' => $num, 'title' => $title]);
    }


    public function postMonthSaleDetail(Request $req)
    {
        $commodity = Commodity::find($req->get('commodityid'));
        $time = [];
        $num = [];
        $avg = 0;
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = $req->get('year')."-0".(string)($month+1);
            }else{
                $ym = $req->get('year')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $num[$month] = (integer)Export::where('commodityid','=',$req->get('commodityid'))->where('created_at','LIKE',$condition)->sum('number');
            $time[$month] = $ym;
            $title = $req->get('year');
            $avg = $avg + $num[$month];
        }
        return view('JXC.manager.commoditySaleChart',['name' => Auth::user()->name, 'commodity' => $commodity, 'time' => $time, 'num' => $num, 'title' => $title]);
    }

    public function getYearSaleDetail($id)
    {
        $commodity = Commodity::find($id);
        $time = ['2011','2012','2013','2014','2015','2016'];
        $num = [];
        $avg = 0;
        for ($i = 0; $i < 6; $i++) {
            $condition = $time[$i]."%";
            $num[$i] = (integer)Export::where('commodityid','=',$id)->where('created_at','LIKE',$condition)->sum('number');
        }
        return view('JXC.manager.commodityYearSaleChart',['name' => Auth::user()->name, 'commodity' => $commodity,'num' => $num]);

    }

    public function getEmployeeAnalysis()
    {
        $users = DB::select('select * from users');
        $hotten = User::scoreMost()->take(5)->get();
        $coldten = User::scoreLeast()->take(5)->get();
        return view('JXC.manager.employeeAnalysis',['name' => Auth::user()->username,'users' => $users, 'hotten' => $hotten, 'coldten' => $coldten]);
    }

    public function getMonthEmployeeDetail($id)
    {
        $user = User::find($id);
        $time = [];
        $import = [];
        $export = [];
        for ($day = 0; $day < 30; $day++) {
            if($day < 9){
                $ym = date('Y')."-".date('m')."-0".(string)($day+1);
            }else{
                $ym = date('Y')."-".date('m')."-".(string)($day+1);
            }
            $condition = $ym."%";
            if($user->type == 2){
                $import[$day] = (integer)Import::where('operatorid','=',$id)->where('type','=',1)->where('created_at','LIKE',$condition)->sum('overall');
                $export[$day] = (integer)Export::where('operatorid','=',$id)->where('type','=',1)->where('created_at','LIKE',$condition)->sum('overall');
            }
            $time[$day] = $ym;
            $title = date('Y')."-".date('m');
        }
        return view('JXC.manager.employeeChart',['name' => Auth::user()->name, 'user' => $user, 'time' => $time, 'import' => $import, 'export' => $export, 'title' => $title]);
    }

    public function postMonthEmployeeDetail(Request $req)
    {
        $user = User::find($req->get('id'));
        $time = [];
        $num = [];
        for ($day = 0; $day < 30; $day++) {
            if($day < 9){
                $ym = $req->get('time')."-0".(string)($day+1);
            }else{
                $ym = $req->get('time')."-".(string)($day+1);
            }
            $condition = $ym."%";
            if($user->type == 1){
                $num[$day] = (integer)Import::where('operatorid','=',$req->get('id'))->where('created_at','LIKE',$condition)->sum('overall');

            }elseif($user->type == 2){
                $num[$day] = (integer)Export::where('operatorid','=',$req->get('id'))->where('created_at','LIKE',$condition)->sum('overall');
            }
            $time[$day] = $ym;
            $title = $req->get('time');
        }
        return view('JXC.manager.employeeChart',['name' => Auth::user()->name, 'user' => $user, 'time' => $time, 'num' => $num, 'title' => $title]);
    }

    public function getYearEmployeeDetail($id)
    {
        $user = User::find($id);
        $time = ['2011','2012','2013','2014','2015','2016'];
        $import = [];
        $export = [];
        for ($i = 0; $i < 6; $i++) {
            $condition = $time[$i]."%";
            if($user->type == 2){
                $import[$i] = (integer)Import::where('operatorid','=',$id)->where('type','=',1)->where('created_at','LIKE',$condition)->sum('overall');
                $export[$i] = (integer)Export::where('operatorid','=',$id)->where('type','=',1)->where('created_at','LIKE',$condition)->sum('overall');
            }
        }
        return view('JXC.manager.employeeYearChart',['name' => Auth::user()->name, 'user' => $user,'export' => $export,'import' => $import]);

    }

    public function getInterestAnalysis()
    {
        $num = [0,0,0,0,0,0,0,0,0,0,0,0];
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = date('Y')."-0".(string)($month+1);
            }else{
                $ym = date('Y')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $exports = Export::where('type','=',1)->where('status','=',1)->where('created_at','LIKE',$condition)->get();
            if(count($exports)){
                for($index = 0; $index<count($exports); $index++){
                    $commodity = Commodity::find($exports[$index]->commodityid);
                    $num[$month] = $num[$month] + ($exports[$index]->overall- $commodity->avgin * $exports[$index]->number);
                }
            }
            $time[$month] = $ym;
        }
        $title = date('Y');

        $yearnum = [0,0,0,0,0,0];
        $year = ['2011','2012','2013','2014','2015','2016'];
        for ($i = 0; $i < 6; $i++) {
            $condition = $year[$i]."%";
            $exports = Export::where('type','=',1)->where('status','=',1)->where('created_at','LIKE',$condition)->get();
            if(count($exports)){
                for($index = 0; $index<count($exports); $index++){
                    $commodity = Commodity::find($exports[$index]->commodityid);
                    $yearnum[$i] = $yearnum[$i] + ($exports[$index]->overall- $commodity->avgin * $exports[$index]->number);
                }
            }
        }
        return view('JXC.manager.interestAnalysis',['name' => Auth::user()->name, 'time' => $time, 'num' => $num, 'yearnum' => $yearnum, 'title' => $title]);
    }


    public function getSpecificYearInterestAnalysis(Request $req)
    {
        $num = [0,0,0,0,0,0,0,0,0,0,0,0];
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = $req->get('year')."-0".(string)($month+1);
            }else{
                $ym = $req->get('year')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $exports = Export::where('type','=',1)->where('status','=',1)->where('created_at','LIKE',$condition)->get();
            if(count($exports)){
                for($index = 0; $index<count($exports); $index++){
                    $commodity = Commodity::find($exports[$index]->commodityid);
                    $num[$month] = $num[$month] + ($exports[$index]->overall- $commodity->avgin * $exports[$index]->number);
                }
            }
            $time[$month] = $ym;
        }
        $title = $req->get('year');

        $yearnum = [0,0,0,0,0,0];
        $year = ['2011','2012','2013','2014','2015','2016'];
        for ($i = 0; $i < 6; $i++) {
            $condition = $year[$i]."%";
            $exports = Export::where('type','=',1)->where('status','=',1)->where('created_at','LIKE',$condition)->get();
            if(count($exports)){
                for($index = 0; $index<count($exports); $index++){
                    $commodity = Commodity::find($exports[$index]->commodityid);
                    $yearnum[$i] = $yearnum[$i] + ($exports[$index]->overall- $commodity->avgin * $exports[$index]->number);
                }
            }
        }
        return view('JXC.manager.interestAnalysis',['name' => Auth::user()->name, 'time' => $time, 'num' => $num, 'yearnum' => $yearnum, 'title' => $title]);

    }
}