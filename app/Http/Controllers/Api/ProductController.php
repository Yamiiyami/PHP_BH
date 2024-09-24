<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\Contracts\IProductRepository;
use App\Models\Product;
use App\Repositories\Contracts\IPictureRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ProductController extends Controller
{
    protected $product; 
    protected $imageRepository;
    public function __construct(IProductRepository $product, IPictureRepository $imageRepository)
    {
        $this->product = $product;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $result = $this->product->GetAll();
        return response()->json($result);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->product->Add($request->validated());
        if($request->hasFile('image')){
            $this->uploadImage($request,$product->id);
        }


        if(!$product){
            return response()->json(['message' => 'tạo thất bại'],400);
        }
        return response()->json(['message' => 'tạo thành công', 'product' => $product],201);
    }

    public function getbyidcate($id){
        return $this->product->GetByIdCate($id);
    }
    public function uploadImage(Request $request, $id){
        return $this->imageRepository->uploadImage($request,$id);
    }

    public function show($id)
    {
        $result = $this->product->GetById($id);
        if(!$result){
            return response()->json(['Message' => "không tìm thấy"],404);
        }
        return response()->json(['product' => $result],200);
    }

    public function update(Request $request, $id)
    {
        $update = $this->product->update($request->all(),$id);
        if(!$update){
            return response()->json(['message' => 'xửa thất bại'],400);
        }
        return response()->json(['message' => 'xửa thành công'],201);
    }

    public function destroy($id)
    {
        $result = $this->product->Delete($id);
        if(!$result){
            return response()->json(['message' => 'xoá thất bại'],400);
        }
        return response()->json(['message' => 'xoá thành công'],200);
    }
}
