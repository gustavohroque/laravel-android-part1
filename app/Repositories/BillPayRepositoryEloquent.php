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

    public function calculateTotal()
    {
        $result = [
            'count' => 0,
            'count_paid' => 0,
            'total_be_paid' => 0
        ];

        $billPays = $this->skipPresenter()->all();
        $result['count'] = $billPays->count();

        foreach($billPays as $billPay) {
            $done = (bool) $billPay->done;
            if($done){
                $result['count_paid']++;
            }else{
                $value = (float) $billPay->value;
                $result['total_be_paid']+=$value;
            }
        }

        return $result ;
    }
}
