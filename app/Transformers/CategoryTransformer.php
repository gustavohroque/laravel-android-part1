<?php

namespace SON\Transformers;

use League\Fractal\TransformerAbstract;
use SON\Models\Category;

/**
 * Class CategoryTransformer
 * @package namespace SON\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the \Category entity
     * @param \Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'            => (int) $model->id,
            'name'          => $model->name,
//            'user_id'          => $model->user_id,
            'created_at'    => $model->created_at,
            'updated_at'    => $model->updated_at
        ];
    }
}
