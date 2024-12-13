<?php

namespace App\Repositories\Product;

use App\Models\MultiImg;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductRepositoryImplement extends Eloquent implements ProductRepository
{
    protected Product $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getData()
    {
        return $this->model->with(['category', 'brand', 'subCategory', 'subSubCategory', 'multiImages'])->latest()->get();
    }

    public function store($data)
    {
        DB::beginTransaction();

        try {
            $data['product_slug'] = Str::slug($data['product_name']);
            $data['selling_price'] = $this->sanitizePrice($data['selling_price']);
            $data['price_after_discount'] = $this->sanitizePrice($data['price_after_discount']);

            $data = $this->handleCheckboxValues($data);

            $product = $this->model->create($data);

            if (!empty($data['product_thumbnail'])) {
                $product->product_thumbnail = $this->uploadFile($data['product_thumbnail'], 'uploads/products/thumbnail');
                $product->save();
            }

            $this->handleMultiImages($product->id, $data['photo_name'] ?? []);

            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function detail($id)
    {
        $product = $this->model->with(['category', 'brand', 'subCategory', 'subSubCategory', 'multiImages'])->find($id);

        // Generate URL for the main thumbnail
        $product['product_thumbnail'] = Storage::url($product['product_thumbnail']);

        // Generate URL for each multi image
        if ($product->multiImages) {
            foreach ($product->multiImages as $key => $image) {
                $product->multiImages[$key]['photo_name'] = Storage::url($image['photo_name']);
            }
        }

        // Format prices
        $product['selling_price'] = format_uang($product['selling_price']);
        $product['price_after_discount'] = format_uang($product['price_after_discount']);

        return $product;
    }

    public function show($id)
    {
        $product = $this->model->with(['category', 'brand', 'subCategory', 'subSubCategory', 'multiImages'])->find($id);
        $product['selling_price'] = format_uang($product['selling_price']);
        $product['price_after_discount'] = format_uang($product['price_after_discount']);

        return $product;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            // Temukan produk berdasarkan ID
            $product = $this->model->findOrFail($id);

            // Perbarui detail produk
            if (isset($data['product_name'])) {
                $data['product_slug'] = Str::slug($data['product_name']);
                $data['product_tags'] = Str::slug($data['product_name']);
                $data['selling_price'] = $this->sanitizePrice($data['selling_price']);
                $data['price_after_discount'] = $this->sanitizePrice($data['price_after_discount']);
            }

            // Menangani nilai checkbox jika ada
            $data = $this->handleCheckboxValues($data);

            // Menangani upload thumbnail jika ada file
            if (isset($data['product_thumbnail'])) {
                // Hapus thumbnail lama jika ada
                $this->deleteFileIfExists($product->product_thumbnail);
                // Unggah thumbnail baru dan simpan produk
                $data['product_thumbnail'] = $this->uploadFile($data['product_thumbnail'], 'uploads/products/thumbnail');
            }

            // Perbarui data produk
            $product->update($data);

            // Menangani pembaruan multi-image (baik untuk memperbarui dan membuat yang baru)
            if (isset($data['photo_name']) && is_array($data['photo_name'])) {
                // Hapus semua gambar multi-image yang ada
                $product->multiImages()->each(function ($image) {
                    $this->deleteFileIfExists($image->photo_name);
                });

                // Hapus semua gambar multi-image yang terkait dengan produk
                $product->multiImages()->delete();

                // Unggah multi-gambar baru
                $this->handleMultiImages($product->id, $data['photo_name']);
            }

            // Komit transaksi
            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->model->with('multiImages')->findOrFail($id);

            $this->deleteFileIfExists($product->product_thumbnail);

            foreach ($product->multiImages as $image) {
                $this->deleteFileIfExists($image->photo_name);
            }

            $product->multiImages()->delete();
            $product->delete();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function handleCheckboxValues($data): array
    {
        foreach (['hot_deals', 'featured', 'special_offer', 'special_deals'] as $key) {
            $data[$key] = isset($data[$key]) ? 1 : 0;
        }
        return $data;
    }

    private function sanitizePrice($price)
    {
        return str_replace('.', '', $price);
    }

    private function handleMultiImages($productId, $images)
    {
        foreach ($images as $image) {
            if ($image instanceof UploadedFile) {
                DB::table('multi_imgs')->insert([
                    'product_id' => $productId,
                    'photo_name' => $this->uploadFile($image, 'uploads/products/multi'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function uploadFile(UploadedFile $file, string $path): string
    {
        $filename = uniqid() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($path, $filename, 'public');
    }

    private function deleteFileIfExists(string $filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
