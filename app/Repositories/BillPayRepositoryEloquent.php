<?php

namespace SON\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SON\Models\BillPay;
use SON\Presenters\BillPayPresenter;


/**
 * Class BillPayRepositoryEloquent
 * @package namespace SON\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillPay::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BillPayPresenter::class;
    }


    public function applyMultitenancy()
    {
        //força que o eloqunte iniciale o multitenancy
        BillPay::clearBootedModels();
    }
}
