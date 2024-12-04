<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Services\Pesanan\PesananService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    private $pesananService;

    public function __construct(PesananService $pesananService)
    {
        $this->pesananService = $pesananService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pesanan.index');
    }

    public function data()
    {
        $result = $this->pesananService->getData();

        return datatables($result)
            ->addIndexColumn()
            ->editColumn('aksi', fn($q) => $this->renderActionButtons($q))
            ->editColumn('status', fn($q) => $this->renderStatusBadge($q))
            ->editColumn('gambar', fn($q) => $this->renderImageColumn($q))
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->pesananService->store($request->all());

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
        $result = $this->pesananService->detail($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->pesananService->show($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->pesananService->update($request->all(), $id);

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
        $result = $this->pesananService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }

    public function updateStatus(Request $request)
    {
        $result = $this->pesananService->updateStatus($request);

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
     * Render action buttons for DataTables.
     */
    protected function renderActionButtons($pemesanan)
    {
        $detailUrl = route('pesanan.detail', $pemesanan->id);

        return '
        <button onclick="detailForm(`' . $detailUrl . '`)" class="btn btn-xs btn-primary">
            <i class="fas fa-eye"></i> Lihat
        </button>
        <button class="btn btn-xs btn-primary change-status" data-id="' . $pemesanan->id . '" data-status="' . $pemesanan->status . '">
            <i class="fas fa-edit"></i> Ubah Status
        </button>
    ';
    }

    /**
     * Render status badge for DataTables.
     */
    protected function renderStatusBadge($pemesanan)
    {
        $badgeClasses = [
            'pending' => 'badge-warning',
            'process' => 'badge-info',
            'completed' => 'badge-success',
            'canceled' => 'badge-danger',
        ];

        $class = $badgeClasses[$pemesanan->status] ?? 'badge-secondary';
        $status = ucfirst($pemesanan->status);

        return '<span class="badge ' . $class . '">' . $status . '</span>';
    }


    /**
     * Render image column for DataTables.
     */
    protected function renderImageColumn($pemesanan)
    {
        if ($pemesanan->gambar) {
            $imageUrl = asset('storage/' . $pemesanan->gambar);
            return '<img src="' . $imageUrl . '" class="img-thumbnail" style="max-width: 100px;">';
        }

        return '<span class="text-muted">Tidak ada gambar</span>';
    }
}
