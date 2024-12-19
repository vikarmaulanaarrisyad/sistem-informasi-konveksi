<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Services\CustomOrder\CustomOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCustomOrderController extends Controller
{
    private $customOrderService;

    public function __construct(CustomOrderService $customOrderService)
    {
        $this->customOrderService = $customOrderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customorder.index');
    }

    public function data()
    {
        $result = $this->customOrderService->getData();

        return datatables($result)
            ->addIndexColumn()
            ->editColumn('price', fn($q) => $this->renderPriceColumns($q))
            ->editColumn('total_price', fn($q) => $this->renderTotalPriceColumns($q))
            ->editColumn('status', fn($q) => $this->renderStatusColumns($q))
            ->editColumn('aksi', fn($q) => $this->renderActionButtons($q))
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->customOrderService->show($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->customOrderService->update($request->all(), $id);

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
        $result = $this->customOrderService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }

    public function downloadDesign($id)
    {
        // Ambil data pesanan berdasarkan ID
        $customOrder = CustomOrder::find($id);

        if (!$customOrder || !$customOrder->file_design) {
            return redirect()->back()->with('error', 'File desain tidak ditemukan.');
        }

        // Path file desain
        $filePath =  $customOrder->file_design;

        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak tersedia di server.');
        }

        // Lakukan download file
        return Storage::download($filePath, $customOrder->file_design);
    }

    /**
     * Render aksi buttons
     */
    protected function renderActionButtons($q)
    {
        if ($q->status == 'Success') {
            return '
              <button onclick="detailData(`' . route('admin.customorders.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fa fa-eye"></i></button>
                <button disabled class="btn btn-xs btn-primary mr-1"><i class="fa fa-pencil-alt"></i></button>
                <a href="' . route('admin.orders.download', $q->id) . '" class="btn btn-xs btn-danger mr-1"><i class="fa fa-download"></i></a>
                ';
        } else {
            return '
                <button onclick="detailData(`' . route('admin.customorders.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fa fa-eye"></i></button>
                <button onclick="updateStatus(`' . route('admin.customorders.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fa fa-pencil-alt"></i></button>
                <a href="' . route('admin.orders.download', $q->id) . '" class="btn btn-xs btn-danger mr-1"><i class="fa fa-download"></i></a>
                ';
        }
    }

    protected function renderStatusColumns($q)
    {
        $color = '';

        switch ($q->status) {
            case 'Pending':
                $color = 'warning';
                break;
            case 'Progress':
                $color = 'info';
                break;

            case 'Success':
                $color = 'success';
                break;

            case 'Canceled':
                $color = 'danger';
                break;

            default:
                # code...
                break;
        }

        return '<span class="badge badge-' . $color . '">' . $q->status . '</span>';
    }

    protected function renderInvoiceNoColumns($q)
    {
        return '<span class="badge badge-info"> ' . $q->invoice_no . '</span>';
    }

    protected function renderPriceColumns($q)
    {
        return format_uang($q->price);
    }

    protected function renderTotalPriceColumns($q)
    {
        return format_uang($q->total_price);
    }
}
