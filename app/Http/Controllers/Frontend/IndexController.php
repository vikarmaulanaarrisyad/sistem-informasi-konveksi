<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->limit(3)->get();
        $categories = Category::with(['subCategory.subSubCategory'])->orderBy('category_name', 'ASC')->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeals = Product::where('hot_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $specialOffer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $specialDeals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();

        $skip_brand_5 = Brand::skip(1)->first();
        $skip_product_5 = Product::where('status', 1)->where('brand_id', $skip_brand_5->id)->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact([
            'sliders',
            'categories',
            'products',
            'featured',
            'specialOffer',
            'hotDeals',
            'specialDeals',
            'skip_product_0',
            'skip_category_0',
            'skip_category_1',
            'skip_product_1',
            'skip_brand_5',
            'skip_product_5'
        ]));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfileEdit()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->numberphone = $request->numberphone;

        $data->save();

        return redirect()->route('dashboard');
    }

    public function changePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.change_password', compact('user'));
    }

    public function userUpdatePassword(Request $request)
    {
        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = Auth::user();

        $hasPassword = User::find($user->id)->password;
        if (Hash::check($request->oldpassword, $hasPassword)) {
            $data = User::find($user->id);
            $data->password = Hash::make($request->password);
            $data->save();

            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }

    public function detail($id, $slug)
    {
        $product = Product::findOrfail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImg = MultiImg::where('product_id', $id)->orderBy('id', 'DESC')->get();

        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->orderBy('id', 'DESC')->get();
        $hotDeals = Product::where('hot_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.detail_product', compact([
            'product',
            'multiImg',
            'product_color',
            'product_size',
            'relatedProduct',
            'hotDeals'
        ]));
    }

    public function subcatProduct($subcat_id, $slug)
    {
        $products = Product::status()->subcategory($subcat_id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.category.product_category', compact('categories', 'products'));
    }

    public function tagProduct($tag)
    {
        $products = Product::status()->tag($tag)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }

    public function subsubcatProduct($subsubcat_id, $slug)
    {
        $products = Product::status()->subsubcategory($subsubcat_id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.category.subsubcategory_product', compact('categories', 'products'));
    }

    // get data product with ajax
    public function getProductModal($id)
    {
        $product = Product::with('brand', 'category')->findOrfail($id);
        $product['product_thumbnail'] = Storage::url($product['product_thumbnail']);
        $color = $product->product_color;
        $product_color = explode(',', $color);
        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }
}
