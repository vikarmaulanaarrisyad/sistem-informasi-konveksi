<?php

namespace App\Repositories\Layanan;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Layanan;

class LayananRepositoryImplement extends Eloquent implements LayananRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Layanan $model;

    public function __construct(Layanan $model)
    {
        $this->model = $model;
    }

    /**
     * getData
     *
     * @return void
     */
    public function getData()
    {
        return $this->model->all();
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
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
        $layanan = $this->model->find($id);
        $layanan->update($data);

        return $layanan;
    }

    public function destroy($id)
    {
        // Find the Layanan record by its ID
        $layanan = $this->model->find($id);
        return $layanan->delete();
    }
}
