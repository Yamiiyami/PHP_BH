<?php

namespace App\Repositories\Eloquent;

use App\Models\cart;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ICartRepository;

class CartRepository extends BaseRepository implements ICartRepository{

    public function __construct(cart $model)
    {
        parent::__construct($model);
    }

}