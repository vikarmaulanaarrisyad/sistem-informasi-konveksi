<?php

namespace App\Services\Kategori;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Kategori\KategoriRepository;
use Illuminate\Support\Facades\Validator;

class KategoriServiceImplement extends ServiceApi implements KategoriService
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
    protected KategoriRepository $mainRepository;

    public function __construct(KategoriRepository $mainRepository)
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
            'nama_kategori' => 'required'
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
            'nama_kategori' => 'required',
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
            'message' => 'Data berhasil dihapus.',
        ];
    }

    public function findByName($data)
    {
        return $this->mainRepository->findByName($data);
    }
}
