<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\IPictureRepository;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\DB;

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
            return response()->json(['message' => 'không tìm thấy ảnh'], 404);
        }
    }
}