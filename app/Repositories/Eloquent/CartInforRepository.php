<?php

namespace App\Repositories\Eloquent;

use App\Models\cartinfo;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ICartInforRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CartInforRepository extends BaseRepository implements ICartInforRepository
{
    public function __construct(cartinfo $model)
    {
        parent::__construct($model);
    }

}
