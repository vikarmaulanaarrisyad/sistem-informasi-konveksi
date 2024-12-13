<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function addToCar1t(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $price = $product->discount_price === 0
            ? $product->selling_price
            : $product->price_after_discount;

        Cart::add([
            'id' => $id,
            'name' => $request->product_name,
            'qty' => $request->qty,
            'price' => $price,
            'weight' => 1,
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'image' => $product->product_thumbnail,
            ],
        ]);

        return response()->json(['success' => 'success', 'message' => 'Data berhasil ditambahkan ke Keranjang']);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrfail($id);

        if ($product->discount_price === 0) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price * $request->qty,
                'weight' => 1,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'image' => Storage::url($product->product_thumbnail)
                ]
            ]);

            return response()->json(['success' => 'Data berhasil ditambahkan ke Keranjang']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->price_after_discount * $request->qty,
                'weight' => 1,
                'options' => [
                    'size' => $request->size,
                    'color' => $request->color,
                    'image' => Storage::url($product->product_thumbnail)
                ]
            ]);
            return response()->json(['success' => 'Data berhasil ditambahkan ke Keranjang']);
        }
    }

    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal =  Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);

        return response()->json(['success' => 'Data Keranjang Berhasil Dihapus']);
    }
}
