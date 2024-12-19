<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\OrderItem;
use LaravelEasyRepository\Implementations\Eloquent;

class OrderRepositoryImplement extends Eloquent implements OrderRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getData()
    {
        return $this->model->all();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($data, $id)
    {
        $query = $this->model->find($id);

        return $query->update($data);
    }

    public function destroy($id)
    {
        $query = $this->model->find($id);
        return $query->delete();
    }

    public function download($id)
    {
        $query = $this->model->find($id);
        $orderItem =  OrderItem::with('product')->where('order_id', $id)->orderBy('id', 'DESC')->get();
        return [
            'order' => $query,
            'orderItems' => $orderItem,
        ];
    }
}
