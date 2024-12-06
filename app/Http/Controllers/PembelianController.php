<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Services\Pembelian\PembelianService;
use Illuminate\Http\Request;

class PembelianController extends Controller
{

    private $pembelianService;

    public function __construct(PembelianService $pembelianService)
    {
        $this->pembelianService = $pembelianService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pembelian.index');
    }

    public function data()
    {
        $result = $this->pembelianService->getData();
        return datatables($result)
            ->addIndexColumn()
            ->editColumn('total_harga', fn($q) => $this->renderTotalHarga($q))
            ->editColumn('kode_pembelian', fn($q) => $this->renderKodePembelian($q))
            ->editColumn('aksi', fn($q) => $this->renderActionButtons($q))
            ->editColumn('status', fn($q) => $this->renderStatusBadge($q))
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->pembelianService->store($request->all());

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

    public function detail($id)
    {
        $result = $this->pembelianService->detail($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->pembelianService->show($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->pembelianService->update($request->all(), $id);

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
        $result = $this->pembelianService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }


    /**
     * Render action buttons for DataTables.
     */
    protected function renderActionButtons($q)
    {
        $detailUrl = route('pembelian.detail', $q->id);

        return '
        <button onclick="detailForm(`' . $detailUrl . '`)" class="btn btn-xs btn-primary">
            <i class="fas fa-eye"></i> Lihat
        </button>
    ';
    }

    /**
     * Render status badge for DataTables.
     */
    protected function renderStatusBadge($q)
    {
        $badgeClasses = [
            'pending' => 'badge-warning',
            'process' => 'badge-info',
            'paid' => 'badge-success',
            'canceled' => 'badge-danger',
        ];

        $class = $badgeClasses[$q->status] ?? 'badge-secondary';
        $status = ucfirst($q->status);

        return '<span class="badge ' . $class . '">' . $status . '</span>';
    }

    /**
     * Render kode pembelian badge for DataTables.
     */
    protected function renderKodePembelian($q)
    {
        return '<span class="badge badge-info">' . $q->kode_pembelian . '</span>';
    }

    /**
     * Render kode pembelian badge for DataTables.
     */
    protected function renderTotalHarga($q)
    {
        return 'Rp. ' . format_uang($q->total_harga);
    }
}
