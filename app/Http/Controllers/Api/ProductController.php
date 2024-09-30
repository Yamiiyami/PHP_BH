<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\Contracts\IProductRepository;
use App\Models\Product;
use App\Repositories\Contracts\IPictureRepository;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ProductController extends Controller
{
    protected $productService; 
    protected $imageService;
    public function __construct(ProductService $productService, ImageService $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function index()
    {
        $result = $this->productService->getAll();
        return response()->json($result);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        if($request->hasFile('image')){
            $this->imageService->uploadImage($request,$product->id);
        }
        if(!$product){
            return response()->json(['message' => 'tạo thất bại'],400);
        }
        return response()->json(['message' => 'tạo thành công', 'product' => $product],201);
    }

    public function getbyidcate($id){
         return $this->productService->getByIdCate($id);
    }

    public function uploadImage(Request $request, $id){
        return $this->imageService->uploadImage($id,$request);
    }

    public function show($id)
    {
        $result = $this->productService->getById($id);
        if(!$result){
            return response()->json(['Message' => "không tìm thấy"],404);
        }
        return response()->json(['product' => $result],200);
    }

    public function update(Request $request, $id)
    {
        $update = $this->productService->update($id, $request->all());
        if(!$update){
            return response()->json(['message' => 'xửa thất bại'],400);
        }
        return response()->json(['message' => 'xửa thành công'],201);
    }

    public function destroy($id)
    {
        $result = $this->productService->delete($id);
        if(!$result){
            return response()->json(['message' => 'xoá thất bại'],400);
        }
        return response()->json(['message' => 'xoá thành công'],200);
    }
}
