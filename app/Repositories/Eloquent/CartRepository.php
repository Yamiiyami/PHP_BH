<?php

namespace App\Repositories\Eloquent;

use App\Models\cart;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ICartRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast;

class CartRepository extends BaseRepository implements ICartRepository{

    protected function __construct(cart $model)
    {
        parent::__construct($model);
    }

    
}