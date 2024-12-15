<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCheckoutController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $total = Cart::total();
                $provinces = Province::all();

                // dd($carts);
                return view('frontend.checkout.index', compact([
                    'carts',
                    'cartQty',
                    'total',
                    'provinces'
                ]));
            } else {
                return redirect()->to('/');
            }
        } else {
            $notification = array(
                'message' => 'Silahkan Login Terlebih Dahulu',
                'error' => 'Silahkan Login Terlebih Dahulu'
            );
            return redirect()->route('login');
        }
    }

    public function detail(Request $request)
    {
        // dd($request->all());

        $carts = Cart::content();
        $total = Cart::total();

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $province = Province::findOrfail($request->province_id);
        $regence = Regency::findOrfail($request->regence_id);
        $district = District::findOrfail($request->district_id);
        $village = Village::findOrfail($request->village_id);
        $address = $request->address;
        $notes = $request->notes;

        return view('frontend.checkout.detail', compact([
            'carts',
            'name',
            'email',
            'phone',
            'province',
            'regence',
            'district',
            'village',
            'address',
            'notes',
            'total'
        ]));
    }

    public function searchProvince(Request $request)
    {
        $keyword = $request->q;
        $result = Province::where('name', 'like', '%' . $keyword . '%')->get();

        return response()->json($result);
    }

    public function searchRegence($province_id)
    {
        $result = Regency::where('province_id', 'like', '%' . $province_id . '%')->get();
        return response()->json($result);
    }

    public function searchDistrict($regency_id)
    {
        $districts = District::where('regency_id', $regency_id)->get(['id', 'name']);
        return response()->json($districts);
    }

    public function searchVillage($district_id)
    {
        $villages = Village::where('district_id', $district_id)->get(['id', 'name']);
        return response()->json($villages);
    }
}
