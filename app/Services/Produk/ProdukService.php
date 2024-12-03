<?php

namespace App\Services\Produk;

use LaravelEasyRepository\BaseService;

interface ProdukService extends BaseService
{
    public function getData();
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id);
}
