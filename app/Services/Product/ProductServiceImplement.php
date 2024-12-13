<?php

namespace App\Services\Product;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Validator;

class ProductServiceImplement extends ServiceApi implements ProductService
{
    protected string $title = "";
    protected ProductRepository $mainRepository;

    public function __construct(ProductRepository $mainRepository)
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
            'brand_id'           => 'required',
            'category_id'        => 'required',
            'subcategory_id'     => 'required',
            'subsubcategory_id'  => 'required',
            'product_code'       => 'required',
            'product_name'       => 'required|string',
            'product_slug'       => 'nullable',
            'product_qty'        => 'required|numeric',
            'product_tags'       => 'nullable|string',
            'product_size'       => 'nullable|string',
            'product_color'      => 'required|string',
            'selling_price'      => 'required|regex:/^[0-9.]+$/',
            'price_after_discount' => 'required|regex:/^[0-9.]+$/',
            'discount_price'     => 'nullable',
            'short_descp'        => 'required|string',
            'long_descp'         => 'required|string',
            'product_thumbnail'  => 'required|mimes:png,jpg,jpeg|max:2048',
            'photo_name'         => 'required|array', // Ensure it is an array
            'photo_name.*'       => 'mimes:png,jpg,jpeg|max:10000', // Validate each file in the array
            'hot_deals'          => 'nullable',
            'featured'           => 'nullable',
            'special_offer'      => 'nullable',
            'special_deals'      => 'nullable',
            'status'             => 'required|in:0,1',
        ]);


        if ($validator->fails()) {
            return [
                'status'  => 'error',
                'errors'  => $validator->errors(),
                'message' => 'Maaf, inputan yang Anda masukkan salah. Silakan periksa kembali dan coba lagi.',
            ];
        }

        // Save to the database
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

    public function detail($id)
    {
        return $this->mainRepository->detail($id);
    }

    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'brand_id'          => 'required',
            'category_id'       => 'required',
            'subcategory_id'    => 'required',
            'subsubcategory_id' => 'required',
            'product_code'      => 'required',
            'product_name'      => 'required|string',
            'product_slug'      => 'nullable',
            'product_qty'       => 'required|numeric',
            'product_tags'      => 'nullable|string',
            'product_size'      => 'nullable|string',
            'product_color'     => 'required|string',
            'selling_price'     => 'required|regex:/^[0-9.]+$/',
            'discount_price'    => 'nullable',
            'short_descp'       => 'required|string',
            'long_descp'        => 'required|string',
            'product_thumbnail' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'hot_deals'         => 'nullable',
            'featured'          => 'nullable',
            'special_offer'     => 'nullable',
            'special_deals'     => 'nullable',
            'status'            => 'required|in:0,1',
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
}
