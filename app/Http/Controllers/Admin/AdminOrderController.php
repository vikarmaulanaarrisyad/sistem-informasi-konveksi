<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Order\OrderService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.order.index');
    }

    public function data()
    {
        $result = $this->orderService->getData();

        return datatables($result)
            ->addIndexColumn()
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
        $result = $this->orderService->show($id);
        return response()->json(['data' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = $this->orderService->update($request->all(), $id);

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
        $result = $this->orderService->destroy($id);

        return response()->json([
            'message' => $result['message'],
        ]);
    }

    public function download($id)
    {
        $result  = $this->orderService->download($id);
        $order = $result['order'];
        $orderItem = $result['orderItems'];

        // Menentukan format tanggal dan jam untuk nama file
        $currentDateTime = Carbon::now()->format('dmY_His');

        // Membuat nama file dengan menambahkan tanggal dan waktu
        $fileName = 'invoice_' . $currentDateTime . '.pdf';

        // Membuat PDF dan mengunduh dengan nama file yang dinamis
        $pdf = Pdf::loadView('admin.order.download', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
            'isRemoteEnabled' => true
        ]);

        return $pdf->download($fileName);
    }

    /**
     * Render aksi buttons
     */
    protected function renderActionButtons($q)
    {
        // <button onclick="editForm(`' . route('admin.orders.show', $q->id) . '`)" class="btn btn-xs btn-primary mr-1"><i class="fa fa-eye"></i></button>
        return '
                <a href="' . route('admin.orders.download', $q->id) . '" class="btn btn-xs btn-danger mr-1"><i class="fa fa-download"></i></a>
                ';
    }

    protected function renderStatusColumns($q)
    {
        $color = '';

        switch ($q->status) {
            case 'Pending':
                $color = 'warning';
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
}
