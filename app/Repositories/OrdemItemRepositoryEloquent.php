<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\OrdemItemRepository;
use CodeDelivery\Models\OrdemItem;
use CodeDelivery\Validators\OrdemItemValidator;

/**
 * Class OrdemItemRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrdemItemRepositoryEloquent extends BaseRepository implements OrdemItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrdemItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
