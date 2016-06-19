<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/19/16
 * Time: 5:54 PM
 */
namespace App\Http\Controllers;

use App\Coupon;
use App\Discount;
use App\Package;
use App\Present;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class StrategyController extends Controller
{

    public function getStrategy()
    {
        $packages = DB::select('select * from packages');
        $presents = DB::select('select * from presents');
        $coupons = DB::select('select * from coupons');
        $discounts = DB::select('select * from discounts');

        return view('JXC.manager.strategy',['packages' => $packages,'presents' => $presents,'coupons' => $coupons,'discounts' => $discounts]);
    }

    public function getPackageDetail($id)
    {
        $package = Package::find($id);
        $commodityfirst = Commodity::find($package->commodityfirst);
        $commoditysecond = Commodity::find($package->commoditysecond);
        return view('JXC.manager.packageDetail',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getPresentDetail($id)
    {
        $present = Present::find($id);
        $commodityfirst = Commodity::find($present->commodityfirst);
        $commoditysecond = Commodity::find($present->commoditysecond);
        return view('JXC.manager.presentDetail',['present' => $present,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);

    }

    public function getCouponDetail($id)
    {
        $coupon = Coupon::find($id);
        return view('JXC.manager.couponDetail',['coupon' => $coupon]);
    }

    public function getDiscountDetail($id)
    {
        $discount = Discount::find($id);
        $commodity = Commodity::find($discount->commodityid);
        return view('JXC.manager.discountDetail',['discount' => $discount,'commodity' => $commodity]);
    }

    public function deleteStrategy(Request $req)
    {
        if($req->get('strategy') == "打折促销"){
            $target = Discount::find($req->get('id'));
        }elseif($req->get('strategy') == "赠品赠送") {
            $target = Present::find($req->get('id'));
        }elseif($req->get('strategy') == "特价包"){
            $target = Present::find($req->get('id'));
        }else{
            $target = Coupon::find($req->get('id'));
        }
        $target->delete();
        return Redirect::back();
    }

    //特价包
    public function getAddPackage()
    {
        $commodities = DB::select('select * from commodities');
        return view('JXC.manager.addPackage',['commodities' => $commodities]);
    }

    public function postAddPackage(Request $req)
    {
        $this->validate($req,[
            'start' => 'required',
            'end' => 'required',
            'level' => 'required',
            'commodityfirst' => 'required',
            'numfirst' => 'required',
            'commoditysecond' => 'required',
            'numsecond' => 'required',
            'set' => 'required',
        ]);
        $package = new Package();
        $package->start = $req->get('start');
        $package->end = $req->get('end');
        $package->level = $req->get('level');
        $package->commodityfirst = $req->get('commodityfirst');
        $package->numfirst = $req->get('numfirst');
        $package->commoditysecond = $req->get('commoditysecond');
        $package->numsecond = $req->get('numsecond');

        $commodityfirst = DB::select('select * from commodities where id = ?', [$req->get('commodityfirst')]);
        $commoditysecond = DB::select('select * from commodities where id = ?', [$req->get('commoditysecond')]);
        $package->init = $commodityfirst[0]->numout * $req->get('numfirst') + $commoditysecond[0]->numout * $req->get('numsecond');
        $package->set = $req->get('set');
        $package->save();
        return Redirect::route('strategy');
    }

    //赠品赠送
    public function getAddPresent()
    {
        $commodities = DB::select('select * from commodities');
        return view('JXC.manager.addPresent',['commodities' => $commodities]);
    }

    public function postAddPresent(Request $req)
    {
        $this->validate($req,[
            'start' => 'required',
            'end' => 'required',
            'level' => 'required',
            'commodityfirst' => 'required',
            'numfirst' => 'required',
            'commoditysecond' => 'required',
            'numsecond' => 'required',
            'condition' => 'required',
        ]);
        $present = new Present();
        $present->start = $req->get('start');
        $present->end = $req->get('end');
        $present->level = $req->get('level');
        $present->commodityfirst = $req->get('commodityfirst');
        $present->numfirst = $req->get('numfirst');
        $present->commoditysecond = $req->get('commoditysecond');
        $present->numsecond = $req->get('numsecond');
        $present->condition = $req->get('condition');
        $present->save();
        return Redirect::route('strategy');
    }

    //代金券赠送
    public function getAddCoupon()
    {
        $commodities = DB::select('select * from commodities');
        return view('JXC.manager.addCoupon',['commodities' => $commodities]);
    }

    public function postAddCoupon(Request $req)
    {
        $this->validate($req,[
            'start' => 'required',
            'end' => 'required',
            'level' => 'required',
            'value' => 'required',
            'number' => 'required',
            'condition' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->start = $req->get('start');
        $coupon->end = $req->get('end');
        $coupon->level = $req->get('level');
        $coupon->value = $req->get('value');
        $coupon->number = $req->get('number');
        $coupon->condition = $req->get('condition');
        $coupon->save();
        return Redirect::route('strategy');
    }

    //打折促销
    public function getAddDiscount()
    {
        $commodities = DB::select('select * from commodities');
        return view('JXC.manager.addDiscount',['commodities' => $commodities]);
    }

    public function postAddDiscount(Request $req)
    {
        $this->validate($req,[
            'start' => 'required',
            'end' => 'required',
            'level' => 'required',
            'commodityid' => 'required',
            'discount' => 'required',
        ]);
        $discount = new Discount();
        $discount->start = $req->get('start');
        $discount->end = $req->get('end');
        $discount->level = $req->get('level');
        $discount->commodityid = $req->get('commodityid');
        $discount->discount = $req->get('discount');
        $discount->save();
        return Redirect::route('strategy');
    }


}