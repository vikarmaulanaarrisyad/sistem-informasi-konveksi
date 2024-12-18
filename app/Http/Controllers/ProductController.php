<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.index');
    }

    public function data()
    {
        $result = $this->productService->getData();

        return datatables($result)
            ->addIndexColumn()
            ->editColumn('product_thumbnail', fn($q) => $this->renderImageColumn($q))
            ->editColumn('selling_price', fn($q) => $this->renderSellingPriceColumn($q))
            ->editColumn('discount_price', fn($q) => $this->renderDiscountPriceColumn($q))
            ->editColumn('price_after_discount', fn($q) => $this->renderPriceAfterDiscountColumn($q))
            ->editColumn('status', fn($q) => $this->renderStatusColumn($q))
            ->editColumn('aksi', fn($q) => $this->renderActionButtons($q))
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->productService->store($request->all());

        if ($result['status'] === 'success') {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
            ], 200);
        }

        return response()->json([
            'success' => false,
            'errors'  => $result['errors'],
            'message' => $result['message'],
        ], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->productService->show($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $result = $this->productService->detail($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->productService->update($request->all(), $id);

        if ($result['status'] === 'success') {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
            ], 200);
        }

        return response()->json([
            'success' => false,
            'errors'  => $result['errors'],
            'message' => $result['message'],
        ], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->productService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }

    /**
     * Render action buttons for DataTables.
     */
    protected function renderActionButtons($q)
    {
        return '
        <button onclick="editForm(`' . route('products.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1">
            <i class="fas fa-pencil-alt"></i>
        </button>
        <button onclick="detailForm(`' . route('products.detail', $q->id) . '`)" class="btn btn-xs btn-info">
            <i class="fas fa-info-circle"></i>
        </button>
        <button onclick="deleteData(`' . route('products.destroy', $q->id) . '`, `' . $q->product_name . '`)" class="btn btn-xs btn-danger mr-1">
            <i class="fas fa-trash-alt"></i>
        </button>
    ';
    }


    /**
     * Render image column for DataTables.
     */
    protected function renderImageColumn($q)
    {
        if ($q->product_thumbnail) {
            $imageUrl = Storage::url($q->product_thumbnail);
            return '<img src="' . $imageUrl . '" class="img-thumbnail" style="max-width: 100px;">';
        }

        return '<span class="text-muted">Tidak ada gambar</span>';
    }

    /**
     * Render status column for DataTables.
     */
    protected function renderStatusColumn($q)
    {
        if ($q->status == 1) {
            // Jika status adalah 1, tampilkan "Aktif"
            return '<span class="badge badge-success">Aktif</span>';
        } else {
            // Jika status adalah 0, tampilkan "Tidak Aktif"
            return '<span class="badge badge-danger">Tidak Aktif</span>';
        }
    }

    /**
     * Render status column for DataTables.
     */
    protected function renderSellingPriceColumn($q)
    {
        return format_uang($q->selling_price);
    }

    /**
     * Render status column for DataTables.
     */
    protected function renderPriceAfterDiscountColumn($q)
    {
        return format_uang($q->discount_price == 0 ? $q->selling_price : $q->price_after_discount);
    }

    /**
     * Render status column for DataTables.
     */
    protected function renderDiscountPriceColumn($q)
    {
        return $q->discount_price . '%';
    }
}
