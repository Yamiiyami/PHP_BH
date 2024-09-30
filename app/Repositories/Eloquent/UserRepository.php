<?php

namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IUserRepository;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements IUserRepository{

    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }


}

