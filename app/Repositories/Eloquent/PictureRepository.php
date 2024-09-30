<?php

namespace App\Repositories\Eloquent;

use App\Models\image;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IPictureRepository;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PictureRepository extends BaseRepository implements IPictureRepository{

    public function __construct(image $model)
    {
        parent::__construct($model);
    }

}