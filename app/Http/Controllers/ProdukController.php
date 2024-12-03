<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Traits\HashFormatRupiah;
use App\Services\Produk\ProdukService;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    private $produkService;

    public function __construct(ProdukService $produkService)
    {
        $this->produkService = $produkService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.produk.index');
    }

    public function data()
    {
        $result = $this->produkService->getData()->load('produkDetails');

        return datatables($result)
            ->addIndexColumn()
            ->editColumn('foto_produk', function ($q) {
                // Check if there is a valid image for the product
                $foto_produk = $q->foto_produk ? Storage::url($q->foto_produk) : asset('storage/produk/default.png');

                // Style the image with CSS
                return '<img src="' . $foto_produk . '" alt="Foto Produk" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
            })
            ->editColumn('qty', function ($q) {
                return $q->produkDetails ? $q->produkDetails->sum('quantity') : 0;
            })
            ->editColumn('aksi', function ($q) {
                return '
                <button onclick="editForm(`' . route('produk.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fas fa-pencil-alt"></i></button>
                <button onclick="deleteData(`' . route('produk.destroy', $q->id) . '`, `' . $q->nama_produk . '`)" class="btn btn-xs btn-danger mr-1"><i class="fas fa-trash-alt"></i></button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->produkService->store($request->all());

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
        // Fetch the product data using the service
        $result = $this->produkService->show($id);

        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->produkService->update($request->all(), $id);

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
        $result = $this->produkService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }
}
