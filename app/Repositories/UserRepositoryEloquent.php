<?php

namespace SON\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SON\Repositories\UserRepository;
use SON\Models\User;
use SON\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace SON\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function create(array $attributes)
    {
        /*
         * A responsabilidade de fazer a encriptação da senha é do repository
         * por siso foi sobreescrito o método
         */
        $attributes['password'] = bcrypt($attributes['password']);
        return parent::create($attributes);
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
