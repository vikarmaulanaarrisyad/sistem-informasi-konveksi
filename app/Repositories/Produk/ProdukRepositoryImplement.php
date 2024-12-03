<?php

namespace App\Repositories\Produk;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LaravelEasyRepository\Implementations\Eloquent;

class ProdukRepositoryImplement extends Eloquent implements ProdukRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Produk $model;

    public function __construct(Produk $model)
    {
        $this->model = $model;
    }
    public function getData()
    {
        return $this->model->with(['kategori', 'produkDetails'])->get();  // Eager load relations
    }

    public function store($data)
    {
        DB::beginTransaction();

        try {
            // Buat slug dan simpan produk utama
            $data['slug'] = Str::slug($data['nama_produk']);

            // If a new file is uploaded, delete the old one and store the new one
            if (isset($data['foto_produk']) && $data['foto_produk'] instanceof \Illuminate\Http\UploadedFile) {
                // Check if the old file exists and delete it (except default image)
                if (isset($data['foto_produk']) && Storage::disk('public')->exists($data['foto_produk'])) {
                    Storage::disk('public')->delete($data['foto_produk']);
                }

                // Upload the new file and get the path
                $data['foto_produk'] = upload('produk', $data['foto_produk'], 'produk');
            }

            // Simpan produk utama
            $produk = $this->model->create([
                'nama_produk'  => $data['nama_produk'],
                'kategori_id'     => $data['kategori'],
                'keterangan'   => $data['keterangan'] ?? null,
                'foto_produk'  => $data['foto_produk'],
                'slug'         => $data['slug'],
            ]);

            // Simpan detail produk jika ada
            if (!empty($data['size'])) {
                foreach ($data['size'] as $index => $size) {
                    // Format harga produk, hilangkan titik (.) jika ada
                    $harga_produk = isset($data['harga_produk'][$index])
                        ? str_replace('.', '', $data['harga_produk'][$index])  // Menghapus titik
                        : 0;

                    $produk->produkDetails()->create([
                        'size'        => $size,
                        'harga_produk' => $harga_produk,
                        'quantity'    => $data['quantity'][$index] ?? 0,
                    ]);
                }
            }

            DB::commit();
            return $produk;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        return $this->model->with(['kategori', 'produkDetails'])->find($id);
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $query = $this->model->find($id);

            if (!$query) {
                throw new \Exception('Produk tidak ditemukan.');
            }

            // If a new file is uploaded, delete the old one and store the new one
            if (isset($data['foto_produk']) && $data['foto_produk'] instanceof \Illuminate\Http\UploadedFile) {
                // Check if the old file exists and delete it (except default image)
                if (Storage::disk('public')->exists($query->foto_produk)) {
                    Storage::disk('public')->delete($query->foto_produk);
                }

                // Upload the new file and get the path
                $data['foto_produk'] = upload('produk', $data['foto_produk'], 'produk');
            }

            // Update the main product data
            $query->update([
                'nama_produk'  => $data['nama_produk'] ?? $query->nama_produk,
                'kategori_id'  => $data['kategori'] ?? $query->kategori_id,
                'keterangan'   => $data['keterangan'] ?? $query->keterangan,
                'foto_produk'  => $data['foto_produk'] ?? $query->foto_produk,
                'slug'         => isset($data['nama_produk']) ? Str::slug($data['nama_produk']) : $query->slug,
            ]);

            // Update or add product details based on size
            if (isset($data['size']) && is_array($data['size'])) {
                foreach ($data['size'] as $index => $size) {
                    $harga_produk = isset($data['harga_produk'][$index])
                        ? str_replace('.', '', $data['harga_produk'][$index]) // Remove dots from price
                        : 0;

                    // Check if the product detail already exists
                    $produkDetail = $query->produkDetails()->where('produk_id', $query->id)
                        ->where('size', $size)
                        ->first();

                    if ($produkDetail) {
                        // If product detail exists, update it
                        $produkDetail->update([
                            'harga_produk' => $harga_produk,
                            'quantity'     => $data['quantity'][$index] ?? 0,
                        ]);
                    }
                }

                // Delete product details that are no longer in the new data
                $existingSizes = $data['size'] ?? [];
                $query->produkDetails()->where('produk_id', $query->id)
                    ->whereNotIn('size', $existingSizes)
                    ->delete();
            }

            DB::commit();
            return $query;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }



    public function update2($data, $id)
    {
        DB::beginTransaction();

        try {
            $query = $this->model->find($id);

            if (!$query) {
                throw new \Exception('Produk tidak ditemukan.');
            }

            // Jika ada gambar baru, hapus gambar lama dan simpan gambar baru
            // if (isset($data['foto_produk'])) {
            //     // Hapus gambar lama jika ada
            //     if (Storage::disk('public')->exists('produk/' . $query->foto_produk) && $query->foto_produk !== 'default.png') {
            //         Storage::disk('public')->delete('produk/' . $query->foto_produk);
            //     }

            //     // Upload gambar baru dan update path-nya
            //     $data['foto_produk'] = upload('produk', $data['foto_produk'], 'produk');
            // }

            if ($data->hasFile('foto_produk')) {
                if (Storage::disk('public')->exists($data->foto_produk)) {
                    Storage::disk('public')->delete($data->foto_produk);
                }

                $data['foto_produk'] = upload('produk', $data->file('foto_produk'), 'produk');
            }

            // Update produk utama
            $query->update([
                'nama_produk'  => $data['nama_produk'] ?? $query->nama_produk,
                'kategori_id'  => $data['kategori'] ?? $query->kategori_id,
                'keterangan'   => $data['keterangan'] ?? $query->keterangan,
                'foto_produk'  => $data['foto_produk'] ?? $query->foto_produk,
                'slug'         => isset($data['nama_produk']) ? Str::slug($data['nama_produk']) : $query->slug,
            ]);

            // Update atau tambah detail produk berdasarkan produk_id
            if (isset($data['size']) && is_array($data['size'])) {
                // Loop melalui setiap size yang dikirim
                foreach ($data['size'] as $index => $size) {
                    $harga_produk = isset($data['harga_produk'][$index])
                        ? str_replace('.', '', $data['harga_produk'][$index]) // Menghapus titik pada harga
                        : 0;

                    // Cari apakah ada produk detail berdasarkan produk_id dan size
                    $produkDetail = $query->produkDetails()->where('produk_id', $query->id) // pastikan produk_id sama
                        ->where('size', $size) // sesuai dengan size yang dikirim
                        ->first();

                    if ($produkDetail) {
                        // Jika produk detail sudah ada, lakukan pembaruan
                        $produkDetail->update([
                            'harga_produk' => $harga_produk,
                            'quantity'     => $data['quantity'][$index] ?? 0,
                        ]);
                    }
                    // else {
                    //     // Jika produk detail tidak ada, buat detail baru
                    //     $query->produkDetails()->create([
                    //         'produk_id'    => $query->id, // gunakan produk_id yang sama
                    //         'size'         => $size,
                    //         'harga_produk' => $harga_produk,
                    //         'quantity'     => $data['quantity'][$index] ?? 0,
                    //     ]);
                    // }
                }

                // Hapus produk detail yang tidak ada dalam data baru berdasarkan produk_id
                $existingSizes = $data['size'] ?? [];
                $query->produkDetails()->where('produk_id', $query->id) // pastikan produk_id yang benar
                    ->whereNotIn('size', $existingSizes) // hapus jika size tidak ada dalam data baru
                    ->delete();
            }


            DB::commit();
            return $query;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $query = $this->model->find($id);

            if (Storage::disk('public')->exists($query->foto_produk)) {
                Storage::disk('public')->delete($query->foto_produk);
            }

            // Delete associated details
            $query->produkDetails()->delete();

            // Delete the product
            $query->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
