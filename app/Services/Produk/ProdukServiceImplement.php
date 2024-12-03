<?php

namespace App\Services\Produk;

use LaravelEasyRepository\ServiceApi;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Produk\ProdukRepository;

class ProdukServiceImplement extends ServiceApi implements ProdukService
{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    protected string $title = "";
    /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected ProdukRepository $mainRepository;

    public function __construct(ProdukRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function getData()
    {
        return $this->mainRepository->getData();
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'nama_produk'    => 'required|string',
            'kategori'       => 'required|string',
            'keterangan'     => 'nullable|string',
            'foto_produk'    => 'nullable|file|image|max:2048', // Validasi file gambar
            'size.*'         => 'required|string',             // Validasi setiap item dalam array size
            'harga_produk.*' => 'required|numeric|min:0',      // Validasi setiap item dalam array harga
            'quantity.*'     => 'required|integer|min:1',      // Validasi setiap item dalam array quantity
        ]);

        if ($validator->fails()) {
            return [
                'status'  => 'error',
                'errors'  => $validator->errors(),
                'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi.',
            ];
        }

        // simpan ke database
        $this->mainRepository->store($data);

        return [
            'status'  => 'success',
            'message' => 'Data berhasil disimpan.',
        ];
    }

    public function show($id)
    {
        return $this->mainRepository->show($id);
    }

    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'nama_produk'    => 'required|string',
            'kategori'       => 'required|string',
            'keterangan'     => 'nullable|string',
            'foto_produk'    => 'nullable|file|image|max:2048', // Validasi file gambar
            'size.*'         => 'required|string',             // Validasi setiap item dalam array size
            'harga_produk.*' => 'required|numeric|min:0',      // Validasi setiap item dalam array harga
            'quantity.*'     => 'required|integer|min:1',      // Validasi setiap item dalam array quantity
        ]);
        if ($validator->fails()) {
            return [
                'status'  => 'error',
                'errors'  => $validator->errors(),
                'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi.',
            ];
        }

        // Update the existing record
        $this->mainRepository->update($data, $id);

        return [
            'status'  => 'success',
            'message' => 'Data berhasil diperbarui.',
        ];
    }

    public function destroy($id)
    {
        $this->mainRepository->destroy($id);

        return [
            'status'  => 'success',
            'message' => 'Data berhasil diperbarui.',
        ];
    }
}
