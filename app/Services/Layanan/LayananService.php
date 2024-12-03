<?php

namespace App\Services\Layanan;

use LaravelEasyRepository\BaseService;

interface LayananService extends BaseService
{
    /**
     * Get all Layanan records.
     *
     * @return mixed
     */
    public function getData();
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id);
}
