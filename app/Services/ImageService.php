<?php

namespace App\Services;

use Exception;
use App\Repositories\Contracts\IPictureRepository;
use App\Repositories\Contracts\IProductRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $imageRepository;
    protected $productRepository;
    public function __construct(IPictureRepository $imageRepository, IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
    }

    public function UploadImage($id, $fileImage)
    {
        DB::beginTransaction();
        try{
            $product = $this->productRepository->find($id);
            if (!$product) {
                throw new Exception('không thấy sản phẩm');
            }
            if ($fileImage->hasFile('image')) 
            {
                $imagePath = $fileImage->file('image')->store('images', 'public');
                
                return $this->imageRepository->create([
                    'image' => $imagePath,
                    'product_id' => $id,
                ]);
            }

            DB::commit();
        }catch(Exception $e)
        {
            DB::rollBack();
            throw new Exception('lỗi không thêm được ảnh'.$e->getMessage());
        }
    }

    public function DeleteImage($id)
    {
        DB::beginTransaction();
        try {
            $image = $this->imageRepository->find($id);
            if (!$image) {
                throw new Exception('không tìm thấy ảnh');
            }
            if (!Storage::disk('public')->delete($image->image)) {
                throw new Exception('không xoá được trong file');
            }
            if(!$this->imageRepository->delete($id)){
                throw new Exception('không xoá được ảnh');
            }
            DB::commit();
            return response()->json(['message' => 'xoá ảnh thành công']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('không xoá được ảnh'.$e->getMessage());
        }
    }

}
