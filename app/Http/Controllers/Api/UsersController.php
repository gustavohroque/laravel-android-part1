<?php

namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Http\Requests\UserRequest;
use SON\Repositories\UserRepository;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    function __construct(UserRepository $repository)
    {
       return $this->repository = $repository ;
    }


    public function store(UserRequest $request)
    {
        $user = $this->repository->create($request->all());

        return response()->json($user,201);
    }
}
