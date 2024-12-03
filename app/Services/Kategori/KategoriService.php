<?php

namespace App\Services\Kategori;

use LaravelEasyRepository\BaseService;

interface KategoriService extends BaseService
{
    public function getData();
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function destroy($id);
}
