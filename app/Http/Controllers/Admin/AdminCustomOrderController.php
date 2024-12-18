<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CustomOrder\CustomOrderService;
use Illuminate\Http\Request;

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
