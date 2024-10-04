<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IOrderRepository;

class OrderRepository extends BaseRepository implements IOrderRepository{

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

}