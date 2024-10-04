<?php

namespace App\Services;

use App\Repositories\Contracts\IRoleRepository;

class RoleService
{
    protected $roleRepository;
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        return $this->roleRepository->all();
    }

}
