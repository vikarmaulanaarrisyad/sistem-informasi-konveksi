<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Carbon\Carbon;
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
        $carts = Cart::content();
        $total = Cart::total();
        $totalAmount = (int) str_replace(',', '', Cart::subtotal());

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $province = Province::findOrfail($request->province_id);
        $regence = Regency::findOrfail($request->regence_id);
        $district = District::findOrfail($request->district_id);
        $village = Village::findOrfail($request->village_id);
        $address = $request->address;
        $notes = $request->notes;

        $orderId = Order::insertGetId([
            'user_id' => Auth::id(),
            'province_id' => $request->province_id,
            'regency_id' => $request->regence_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'amount' => $totalAmount,
            'invoice_no' => 'INV' . rand(100000000000, 999999999999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
        ]);

        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $orderId,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $totalAmount
            ),

            'customer_details' => array(
                'first_name' => $name,
                'email' => $email,
                'phone' => $phone
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        Cart::destroy();

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
            'total',
            'snapToken',
            'orderId'
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

    public function checkoutStore(Request $request)
    {
        $id_order = $request->id_order;
        $data = json_decode($request->get('json'));
        Order::findOrfail($id_order)->update([
            'status' => 'Success',
            'payment_type' => $data->payment_type,
            'transaction_id' => $data->transaction_id
        ]);

        $notification = [
            'message' => 'Pembayaran Success',
            'alert-type' => 'success',
        ];

        return redirect()->url('/user/my-order')->with($notification);
    }
}
