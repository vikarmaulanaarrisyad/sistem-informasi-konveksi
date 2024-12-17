<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.user.order.index', compact('orders'));
    }

    public function orderDetail($orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->orderBy('id', 'DESC')->first();
        $orderItem = OrderItem::with('product')->where('order_id', $orderId)->orderBy('id', 'DESC')->get();

        return view('frontend.user.order.detail', compact('order', 'orderItem'));
    }

    public function downloadInvoice($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->orderBy('id', 'DESC')->first();
        $orderItem = OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        // return view('frontend.user.invoice.pdf', compact('order', 'orderItem'));

        $pdf = Pdf::loadView('frontend.user.invoice.pdf', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
            'isRemoteEnabled' => true
        ]);
        return $pdf->download('invoice.pdf');
    }
}
