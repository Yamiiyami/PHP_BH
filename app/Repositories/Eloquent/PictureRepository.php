<?php

namespace App\Repositories\Eloquent;

use App\Models\image;
use App\Models\Product;
use App\Repositories\Contracts\IPictureRepository;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PictureRepository implements IPictureRepository{

    public function UploadImage( $image,$id) {
        $product = Product::find($id);
        if($product)
        {
            if ($image->hasFile('image')) 
            {
                $imagePath = $image->file('image')->store('images', 'public');
                DB::table('images')->insert([
                    'image' => $imagePath,
                    'product_id' => $id,
                ]);
                return response()->json([
                    'message' => 'Upload ảnh thành công',
                    'image_path' => $imagePath
                ], 200);
            }
            return response()->json(['message' => 'Không có ảnh được tải lên'], 400);
        }else{
            return response()->json(['message' => 'không tìm thấy '], 404);
        }
    }

    public function DeleteImage($id){
        DB::beginTransaction();
        try{
            $image = image::find($id);
            if(!$image){
                return response()->json(['message'=>'không tìm thấy ảnh'],404);
            }
            if(Storage::disk('public')->delete($image->image)){
                throw new \Exception('không xoá được trong file');
            }
            $image->delete();
            DB::commit();
            return response()->json(['message'=>'xoá ảnh thành công']);

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['message'=> $e->getMessage()],500);
        }
       
    }
}